<?php
namespace App\Core;
/**
 * Roteador HTTP simples e direto para arquitetura MVC em PHP puro.
 */
class Roteador
{
    private array $rotas = [];
    /**
     * Registra uma rota GET.
     *
     * @param string $caminho Caminho da URL (ex: '/tutores')
     * @param string $controller Nome da classe do Controller (ex: TutorController::class)
     * @param string $acao Nome do método do Controller (ex: 'index')
     */
    public function get(string $caminho, string $controller, string $acao): void
    {
        $this->adicionar('GET', $caminho, $controller, $acao);
    }
    /**
     * Registra uma rota POST.
     *
     * @param string $caminho Caminho da URL (ex: '/tutores/salvar')
     * @param string $controller Nome da classe do Controller
     * @param string $acao Nome do método do Controller
     */
    public function post(string $caminho, string $controller, string $acao): void
    {
        $this->adicionar('POST', $caminho, $controller, $acao);
    }
    /**
     * Adiciona rota à tabela interna.
     */
    private function adicionar(string $metodo, string $caminho, string $controller, string $acao): void
    {

           $caminhoNormalizado = '/' . trim($caminho, '/');
        if ($caminhoNormalizado === '//') {
            $caminhoNormalizado = '/';
        }
        $this->rotas[$metodo][$caminhoNormalizado] = [
            'controller' => $controller,
            'acao' => $acao,
        ];
    }
    /**
     * Resolve a requisição atual executando o controller e método correspondentes.
     */
    public function despachar(): void
    {
        $metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        // Separa o caminho da query string
        $partes = parse_url($uri);
        $caminho = $partes['path'] ?? '/';
        // Suporte para execução via parâmetro ?url= ou subpastas
        if (isset($_GET['r'])) {
            $caminho = '/' . trim((string)$_GET['r'], '/');
        }
        $caminhoNormalizado = '/' . trim($caminho, '/');
        if ($caminhoNormalizado === '//') {
            $caminhoNormalizado = '/';
        }
        if (isset($this->rotas[$metodo][$caminhoNormalizado])) {
            $rota = $this->rotas[$metodo][$caminhoNormalizado];
            $classe = $rota['controller'];
            $acao = $rota['acao'];

                     if (class_exists($classe)) {
                $instancia = new $classe();
                if (method_exists($instancia, $acao)) {
                    $instancia->$acao();
                    return;
                }
            }
        }
        // Caso a rota não seja encontrada
        http_response_code(404);
        echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><title>404 - Não Encontrado</title>";
        echo "<style>body{font-family:sans-serif;text-align:center;padding:50px;color:#333;}h1{color:#e53e3e;}a{color:#3182ce;text-decoration:none;font-weight:bold;}</style></head>";
        echo "<body><h1>404 - Página Não Encontrada</h1><p>A rota solicitada <code>" . htmlspecialchars($caminhoNormalizado, ENT_QUOTES, 'UTF-8') . "</code> não existe.</p><p><a href='/'>Voltar para o Início</a></p></body></html>";
    }
}