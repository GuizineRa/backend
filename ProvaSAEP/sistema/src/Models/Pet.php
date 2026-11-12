<?php
namespace App\Models;
use App\Core\ConexaoBanco;
use InvalidArgumentException;
use PDO;
/**
 * Model para gerenciamento de animais (pets).
 * Regra obrigatória: todo pet deve pertencer a um tutor previamente cadastrado.
 */
class Pet
{
    /**
     * Lista todos os pets cadastrados juntamente com o nome do respectivo tutor.
     *
     * @return array
     */
    public static function listar(): array
    {
        $pdo = ConexaoBanco::getConexao();
        $sql = "SELECT p.id, p.nome, p.especie, p.raca, p.data_nascimento, p.criado_em,
                       t.id AS tutor_id, t.nome AS tutor_nome
                FROM pets p
                INNER JOIN tutores t ON p.tutor_id = t.id
                ORDER BY p.nome ASC";
        return $pdo->query($sql)->fetchAll();
    }
    /**
     * Busca um pet por seu ID.
     *
     * @param int $id
     * @return array|null
     */
    public static function buscarPorId(int $id): ?array
    {
                $pdo = ConexaoBanco::getConexao();
        $sql = "SELECT p.id, p.nome, p.especie, p.raca, p.data_nascimento, p.tutor_id,
                       t.nome AS tutor_nome
                FROM pets p
                INNER JOIN tutores t ON p.tutor_id = t.id
                WHERE p.id = :id
                LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $registro = $stmt->fetch();
        return $registro ?: null;
    }
    /**
     * Cadastra um novo pet associado obrigatoriamente a um tutor existente.
     *
     * @param int $tutorId ID do tutor obrigatório
     * @param string $nome Nome do animal
     * @param string $especie Espécie (Cachorro, Gato, etc.)
     * @param string $raca Raça
     * @param string $dataNascimento Data de nascimento (YYYY-MM-DD)
     * @return int ID do pet inserido
     * @throws InvalidArgumentException Se o tutor não existir
     */
    public static function criar(int $tutorId, string $nome, string $especie, string $raca, string $dataNascimento): int
    {
        $pdo = ConexaoBanco::getConexao();

                // Validação obrigatória da existência do tutor
        $stmtTutor = $pdo->prepare("SELECT id FROM tutores WHERE id = :id LIMIT 1");
        $stmtTutor->execute([':id' => $tutorId]);
        if (!$stmtTutor->fetch()) {
            throw new InvalidArgumentException("O tutor informado (ID {$tutorId}) não existe. O pet deve ser associado a um tutor cadastrado.");
        }
        $sql = "INSERT INTO pets (tutor_id, nome, especie, raca, data_nascimento)
                VALUES (:tutor_id, :nome, :especie, :raca, :data_nascimento)
                RETURNING id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':tutor_id' => $tutorId,
            ':nome' => trim($nome),
            ':especie' => trim($especie),
            ':raca' => trim($raca),
            ':data_nascimento' => trim($dataNascimento),
        ]);
        return (int)$stmt->fetchColumn();
    }
    /**
     * Retorna a contagem total de pets cadastrados.
     *
     * @return int
     */
    public static function contar(): int
    {
        $pdo = ConexaoBanco::getConexao();
        return (int)$pdo->query("SELECT COUNT(*) FROM pets")->fetchColumn();
    }
}