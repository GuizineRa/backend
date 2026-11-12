<?php
namespace App\Core;
use PDO;
use PDOException;
use RuntimeException;
/**
 * Classe responsável pelo gerenciamento da conexão com o banco de dados PostgreSQL via PDO.
 * Implementa padrão Singleton para garantir instância única da conexão durante o ciclo de vida da requisição.
 */
class ConexaoBanco
{
    private static ?PDO $instancia = null;
    private static ?array $config = null;
    /**
     * Construtor privado para impedir instanciação direta.
     */
    private function __construct()
    {
    }
    /**
     * Carrega as configurações do arquivo database.ini ou variáveis de ambiente.
     *
     * @return array
     */
    public static function carregarConfig(): array
    {
        if (self::$config !== null) {
            return self::$config;
        }

                $caminhoIni = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'database.ini';
        if (!file_exists($caminhoIni)) {
            throw new RuntimeException("Arquivo de configuração não encontrado: {$caminhoIni}");
        }
        $parsed = parse_ini_file($caminhoIni, true);
        if ($parsed === false) {
            throw new RuntimeException("Falha ao analisar o arquivo de configuração: {$caminhoIni}");
        }
        self::$config = $parsed;
        return self::$config;
    }
    /**
     * Retorna a instância ativa do PDO conectada ao PostgreSQL.
     *
     * @return PDO
     * @throws RuntimeException Em caso de erro na conexão.
     */
    public static function getConexao(): PDO
    {
        if (self::$instancia === null) {
            $config = self::carregarConfig();
            $dbConfig = $config['database'] ?? [];
            // Permite sobrescrever via variáveis de ambiente quando disponíveis
            $host = getenv('DB_HOST') ?: ($dbConfig['host'] ?? 'localhost');
            $port = getenv('DB_PORT') ?: ($dbConfig['port'] ?? '5432');
            $dbname = getenv('DB_NAME') ?: ($dbConfig['dbname'] ?? 'clinica_vet');
            $user = getenv('DB_USER') ?: ($dbConfig['user'] ?? 'postgres');
            $password = getenv('DB_PASSWORD') ?: ($dbConfig['password'] ?? '');
            $dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";

                     try {
                self::$instancia = new PDO($dsn, $user, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                throw new RuntimeException("Erro ao conectar ao PostgreSQL: " . $e->getMessage(), (int)$e->getCode(), $e);
            }
        }
        return self::$instancia;
    }
}