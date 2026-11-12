<?php
namespace App\Core;
/**
 * Classe responsável pelo controle de sessão, autenticação e expiração por inatividade.
 */
class AuthGuard
{
    private const TEMPO_EXPIRACAO_PADRAO = 1800; // 30 minutos em segundos
    /**
     * Inicia a sessão PHP de forma segura caso ainda não tenha sido iniciada.
     */
    public static function iniciarSessao(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            // Configurações de segurança para cookies de sessão
            ini_set('session.cookie_httponly', '1');
            ini_set('session.use_only_cookies', '1');
            ini_set('session.cookie_samesite', 'Lax');
            session_start();
        }
    }
    /**
     * Obtém o tempo limite de inatividade em segundos a partir da configuração.
     *
     * @return int
     */
    public static function obterTempoExpiracao(): int
    {
        try {
            $config = ConexaoBanco::carregarConfig();
            $tempo = (int)($config['security']['session_lifetime'] ?? self::TEMPO_EXPIRACAO_PADRAO);
            return $tempo > 0 ? $tempo : self::TEMPO_EXPIRACAO_PADRAO;
        } catch (\Throwable $e) {
            return self::TEMPO_EXPIRACAO_PADRAO;
        }
    }

        /**
     * Registra o login do usuário na sessão com timestamp atual.
     *
     * @param array $usuario Dados do usuário autenticado (id, nome, email)
     */
    public static function login(array $usuario): void
    {
        self::iniciarSessao();
        // Regenera o ID de sessão para prevenir Session Fixation
        session_regenerate_id(true);
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'email' => $usuario['email'],
        ];
        $_SESSION['ultimo_acesso'] = time();
    }
    /**
     * Encerra a sessão do usuário e limpa os dados.
     */
    public static function logout(): void
    {
        self::iniciarSessao();
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

              session_destroy();
    }
    /**
     * Verifica se o usuário atual está autenticado e se a sessão não expirou.
     * Redireciona para o login caso a sessão seja inválida ou expirada.
     */
    public static function verificarAutenticacao(): void
    {
        self::iniciarSessao();
        if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
            header('Location: /login');
            exit;
        }
        $tempoLimite = self::obterTempoExpiracao();
        $ultimoAcesso = $_SESSION['ultimo_acesso'] ?? 0;
        if ((time() - $ultimoAcesso) > $tempoLimite) {
            self::logout();
            header('Location: /login?erro=expirada');
            exit;
        }
        // Atualiza o timestamp do último acesso para renovar a janela de atividade
        $_SESSION['ultimo_acesso'] = time();
    }
    /**
     * Retorna se há usuário logado e com sessão ativa.
     *
     * @return bool
     */
    public static function estaAutenticado(): bool
    {
        self::iniciarSessao();
        if (!isset($_SESSION['usuario'])) {
            return false;
        }

              $tempoLimite = self::obterTempoExpiracao();
        $ultimoAcesso = $_SESSION['ultimo_acesso'] ?? 0;
        return (time() - $ultimoAcesso) <= $tempoLimite;
    }
    /**
     * Retorna os dados do usuário atualmente autenticado.
     *
     * @return array|null
     */
    public static function usuario(): ?array
    {
        self::iniciarSessao();
        return $_SESSION['usuario'] ?? null;
    }
}