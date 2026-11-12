<?php
namespace App\Models;
use App\Core\ConexaoBanco;
use App\Core\Criptografia;
use PDO;
/**
 * Model para gerenciamento de tutores.
 * O CPF é armazenado de forma criptografada (AES-256-CBC) para atendimento às diretrizes da LGPD.
 */
class Tutor
{
    /**
     * Lista tutores com suporte a busca textual por nome ou por CPF.
     * Como o CPF é criptografado com IV aleatório (não determinístico para máxima segurança),
     * a busca por CPF é realizada após a descriptografia em memória com tratamento cuidadoso.
     *
     * @param string|null $busca Termo de busca (nome, CPF, email ou telefone)
     * @return array Lista de tutores com campos descriptografados prontos para uso
     */
    public static function listar(?string $busca = null): array
    {
        $pdo = ConexaoBanco::getConexao();
        // Obtém todos os tutores cadastrados ordenados pelo nome
        $stmt = $pdo->query("SELECT id, nome, cpf, telefone, email, criado_em FROM tutores ORDER BY nome ASC");
        $registros = $stmt->fetchAll();
        $termo = $busca !== null ? trim($busca) : '';
        $termoLimpoCpf = Criptografia::limparCpf($termo);
        $resultado = [];
        foreach ($registros as $tutor) {
            // Descriptografa o CPF apenas no momento necessário
                        $cpfOriginal = Criptografia::descriptografar($tutor['cpf']);
            $cpfLimpo = Criptografia::limparCpf($cpfOriginal);
            $cpfFormatado = Criptografia::formatarCpf($cpfOriginal);
            $cpfMascarado = Criptografia::mascararCpf($cpfOriginal);
            $tutorTratado = [
                'id' => (int)$tutor['id'],
                'nome' => $tutor['nome'],
                'cpf' => $tutor['cpf'], // hash/cifra bruta no banco
                'cpf_descriptografado' => $cpfOriginal,
                'cpf_formatado' => $cpfFormatado,
                'cpf_mascarado' => $cpfMascarado,
                'telefone' => $tutor['telefone'],
                'email' => $tutor['email'],
                'criado_em' => $tutor['criado_em'],
            ];
            // Se não há filtro de busca, inclui todos os registros
            if ($termo === '') {
                $resultado[] = $tutorTratado;
                continue;
            }
            // Critérios de busca cuidadosa por nome ou CPF
            $correspondeNome = mb_stripos($tutor['nome'], $termo) !== false;
            $correspondeEmail = mb_stripos($tutor['email'], $termo) !== false;
            $correspondeTelefone = str_contains($tutor['telefone'], $termo);

             // Verificação do CPF pelo valor numérico ou formatado
            $correspondeCpf = false;
            if ($termoLimpoCpf !== '' && str_contains($cpfLimpo, $termoLimpoCpf)) {
                $correspondeCpf = true;
            } elseif (str_contains($cpfFormatado, $termo)) {
                $correspondeCpf = true;
            }
            if ($correspondeNome || $correspondeCpf || $correspondeEmail || $correspondeTelefone) {
                $resultado[] = $tutorTratado;
            }
        }
        return $resultado;
    }
    /**
     * Busca um tutor específico por seu ID.
     *
     * @param int $id
     * @return array|null
     */
    public static function buscarPorId(int $id): ?array
    {
        $pdo = ConexaoBanco::getConexao();
        $stmt = $pdo->prepare("SELECT id, nome, cpf, telefone, email, criado_em FROM tutores WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $tutor = $stmt->fetch();
        if (!$tutor) {
            return null;
        }
        $cpfOriginal = Criptografia::descriptografar($tutor['cpf']);
        $tutor['cpf_descriptografado'] = $cpfOriginal;
        $tutor['cpf_formatado'] = Criptografia::formatarCpf($cpfOriginal);
        $tutor['cpf_mascarado'] = Criptografia::mascararCpf($cpfOriginal);
        return $tutor;
    }

     /**
     * Cadastra um novo tutor com CPF criptografado via AES-256-CBC.
     *
     * @param string $nome
     * @param string $cpf
     * @param string $telefone
     * @param string $email
     * @return int ID do tutor criado
     */
    public static function criar(string $nome, string $cpf, string $telefone, string $email): int
    {
        $pdo = ConexaoBanco::getConexao();
        $cpfLimpo = Criptografia::limparCpf($cpf);
        $cpfCriptografado = Criptografia::criptografar($cpfLimpo);
        $sql = "INSERT INTO tutores (nome, cpf, telefone, email) 
                VALUES (:nome, :cpf, :telefone, :email) 
                RETURNING id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => trim($nome),
            ':cpf' => $cpfCriptografado,
            ':telefone' => trim($telefone),
            ':email' => trim($email),
        ]);
        return (int)$stmt->fetchColumn();
    }

 /**
     * Atualiza os dados de um tutor existente.
     *
     * @param int $id
     * @param string $nome
     * @param string $cpf
     * @param string $telefone
     * @param string $email
     * @return bool
     */
    public static function atualizar(int $id, string $nome, string $cpf, string $telefone, string $email): bool
    {
        $pdo = ConexaoBanco::getConexao();
        $cpfLimpo = Criptografia::limparCpf($cpf);
        $cpfCriptografado = Criptografia::criptografar($cpfLimpo);
        $sql = "UPDATE tutores 
                SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email 
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nome' => trim($nome),
            ':cpf' => $cpfCriptografado,
            ':telefone' => trim($telefone),
            ':email' => trim($email),
        ]);
    }

        /**
     * Retorna a contagem total de tutores cadastrados.
     *
     * @return int
     */
    public static function contar(): int
    {
        $pdo = ConexaoBanco::getConexao();
        return (int)$pdo->query("SELECT COUNT(*) FROM tutores")->fetchColumn();
    }
}