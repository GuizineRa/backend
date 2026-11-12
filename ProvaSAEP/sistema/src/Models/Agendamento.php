<?php
namespace App\Models;
use App\Core\ConexaoBanco;
use App\Core\Criptografia;
use InvalidArgumentException;
use PDO;
/**
 * Model para gerenciamento de agendamentos e consultas.
 * Regras:
 * - Listagem ordenada crescentemente pela data do agendamento.
 * - Exibição completa dos dados do pet e do tutor associado.
 * - Alteração da data de consultas já agendadas.
 */
class Agendamento
{
    /**
     * Lista todos os agendamentos ordenados pela data_agendamento de forma ascendente.
     * Inclui os dados do pet e do tutor responsável (com CPF tratado com segurança).
     *
     * @return array
     */
    public static function listarOrdenadoPorData(): array
    {
        $pdo = ConexaoBanco::getConexao();
        $sql = "SELECT a.id, a.data_agendamento, a.motivo, a.status, a.criado_em,
                       p.id AS pet_id, p.nome AS pet_nome, p.especie AS pet_especie, p.raca AS pet_raca,
                       t.id AS tutor_id, t.nome AS tutor_nome, t.cpf AS tutor_cpf, t.telefone AS tutor_telefone
                FROM agendamentos a
                INNER JOIN pets p ON a.pet_id = p.id
                INNER JOIN tutores t ON p.tutor_id = t.id
                ORDER BY a.data_agendamento ASC";
        $registros = $pdo->query($sql)->fetchAll();

                foreach ($registros as &$item) {
            // Descriptografa o CPF do tutor e mascara para exibição segura na listagem de consultas
            $cpfOriginal = Criptografia::descriptografar($item['tutor_cpf']);
            $item['tutor_cpf_mascarado'] = Criptografia::mascararCpf($cpfOriginal);
            $item['tutor_cpf_formatado'] = Criptografia::formatarCpf($cpfOriginal);
        }
        return $registros;
    }
    /**
     * Busca um agendamento específico pelo ID com os dados do pet e tutor.
     *
     * @param int $id
     * @return array|null
     */
    public static function buscarPorId(int $id): ?array
    {
        $pdo = ConexaoBanco::getConexao();
        $sql = "SELECT a.id, a.pet_id, a.data_agendamento, a.motivo, a.status, a.criado_em,
                       p.nome AS pet_nome, p.especie AS pet_especie,
                       t.nome AS tutor_nome
                FROM agendamentos a
                INNER JOIN pets p ON a.pet_id = p.id
                INNER JOIN tutores t ON p.tutor_id = t.id
                WHERE a.id = :id
                LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $registro = $stmt->fetch();

              return $registro ?: null;
    }
    /**
     * Cria um novo agendamento no sistema.
     *
     * @param int $petId ID do pet
     * @param string $dataAgendamento Data e hora no formato ISO (YYYY-MM-DD HH:MM:SS)
     * @param string $motivo Motivo da consulta
     * @param string $status Status inicial
     * @return int ID do agendamento criado
     */
    public static function criar(int $petId, string $dataAgendamento, string $motivo, string $status = 'Agendado'): int
    {
        $pdo = ConexaoBanco::getConexao();
        // Valida se o pet existe
        $stmtPet = $pdo->prepare("SELECT id FROM pets WHERE id = :id LIMIT 1");
        $stmtPet->execute([':id' => $petId]);
        if (!$stmtPet->fetch()) {
            throw new InvalidArgumentException("O pet informado não existe.");
        }

            $sql = "INSERT INTO agendamentos (pet_id, data_agendamento, motivo, status)
                VALUES (:pet_id, :data_agendamento, :motivo, :status)
                RETURNING id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':pet_id' => $petId,
            ':data_agendamento' => trim($dataAgendamento),
            ':motivo' => trim($motivo),
            ':status' => trim($status),
        ]);
        return (int)$stmt->fetchColumn();
    }
    /**
     * Altera a data de um agendamento já cadastrado e salva no banco de dados.
     *
     * @param int $id ID do agendamento
     * @param string $novaData Nova data e hora do agendamento
     * @return bool
     */
    public static function atualizarData(int $id, string $novaData): bool
    {
            $pdo = ConexaoBanco::getConexao();
        $sql = "UPDATE agendamentos 
                SET data_agendamento = :nova_data 
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nova_data' => trim($novaData),
        ]);
    }
    /**
     * Retorna a contagem total de agendamentos.
     *
     * @return int
     */
    public static function contar(): int
    {
        $pdo = ConexaoBanco::getConexao();
        return (int)$pdo->query("SELECT COUNT(*) FROM agendamentos")->fetchColumn();
    }
}