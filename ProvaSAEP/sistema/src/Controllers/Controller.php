<?php
namespace App\Controllers;
use App\Core\AuthGuard;
/**
 * Controller base com utilitários de renderização de views, mensagens flash e redirecionamento.
 */
abstract class Controller
{
    /**
     * Renderiza uma view dentro de um layout com os dados fornecidos.
     *
     * @param string $view Caminho relativo da view (ex: 'tutores/index')
     * @param array $dados Dados a serem disponibilizados na view
     * @param string $layout Layout que envelopa a view (padrão: 'layout/main')
     */
    protected function render(string $view, array $dados = [], string $layout = 'layout/main'): void
    {
        // Disponibiliza as variáveis extraídas para a view
        extract($dados, EXTR_SKIP);
        // Dados globais para o layout
        $usuarioLogado = AuthGuard::usuario();
        $mensagemFlash = $this->obterFlash();
        $caminhoView = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $view) . '.php';
        if (!file_exists($caminhoView)) {
            throw new \RuntimeException("Arquivo de View não encontrado: {$caminhoView}");
        }

           // Captura o HTML da view no buffer
        ob_start();
        require $caminhoView;
        $conteudo = ob_get_clean();
        // Renderiza o layout envelopando o conteúdo
        $caminhoLayout = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $layout) . '.php';
        if (!file_exists($caminhoLayout)) {
            // Se o layout não existir, exibe o conteúdo direto
            echo $conteudo;
            return;
        }
        require $caminhoLayout;
    }
    /**
     * Redireciona para outra URL e finaliza o script.
     *
     * @param string $url
     */
    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }

     /**
     * Registra uma mensagem flash para ser exibida na próxima requisição.
     *
     * @param string $tipo 'sucesso', 'erro' ou 'info'
     * @param string $texto Texto da mensagem
     */
    protected function flash(string $tipo, string $texto): void
    {
        AuthGuard::iniciarSessao();
        $_SESSION['flash'] = [
            'tipo' => $tipo,
            'texto' => $texto,
        ];
    }
    /**
     * Recupera e consome a mensagem flash da sessão.
     *
     * @return array|null
     */
    protected function obterFlash(): ?array
    {
        AuthGuard::iniciarSessao();
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }
}