<?php
namespace App\Models;
use App\Core\ConexaoBanco;
use PDO;
/**
 * Model para gerenciamento de operadores e usuários do sistema.
 */
class Usuario
{
    /**
     * Busca um usuário pelo e-mail com Prepared Statement.
     *
     * @param string $email
     * @return array|null
     */
    public static function buscarPorEmail(string $email): ?array
    {
        $pdo = ConexaoBanco::getConexao();
        $stmt = $pdo->prepare("SELECT id, nome, email, senha, criado_em FROM usuarios WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => trim($email)]);
        $resultado = $stmt->fetch();
        return $resultado ?: null;
    }
    /**
     * Busca um usuário pelo ID com Prepared Statement.
     *
     * @param int $id
     * @return array|null
     */
    public static function buscarPorId(int $id): ?array
    {
        $pdo = ConexaoBanco::getConexao();
        $stmt = $pdo->prepare("SELECT id, nome, email, criado_em FROM usuarios WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $resultado = $stmt->fetch();
        return $resultado ?: null;
    }
}