<?php
namespace App\Controllers;
use App\Core\AuthGuard;
use App\Models\Usuario;
/**
 * Controller responsável pela autenticação de usuários, login e encerramento de sessão.
 */
class AuthController extends Controller
{
    /**
     * Exibe o formulário de login.
     */
    public function login(): void
    {
        if (AuthGuard::estaAutenticado()) {
            $this->redirect('/');
        }
        $erro = $_GET['erro'] ?? null;
        $mensagemErro = null;
        if ($erro === 'credenciais') {
            $mensagemErro = 'E-mail ou senha incorretos. Por favor, verifique seus dados de acesso.';
        } elseif ($erro === 'expirada') {
            $mensagemErro = 'Sua sessão expirou por inatividade (30 minutos). Efetue o login novamente para continuar.';
        }
        $sucesso = $_GET['sucesso'] ?? null;
        $mensagemSucesso = null;
        if ($sucesso === 'logout') {
            $mensagemSucesso = 'Você saiu do sistema com segurança.';
        }
        $this->render('auth/login', [
            'mensagemErro' => $mensagemErro,
            'mensagemSucesso' => $mensagemSucesso,
        ], 'layout/auth');
    }

     /**
     * Processa a submissão do formulário de autenticação.
     */
    public function autenticar(): void
    {
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';
        if (empty($email) || empty($senha)) {
            $this->render('auth/login', [
                'mensagemErro' => 'Por favor, preencha o e-mail e a senha.',
                'email' => $email,
            ], 'layout/auth');
            return;
        }
        $usuario = Usuario::buscarPorEmail($email);
        if (!$usuario || !password_verify($senha, $usuario['senha'])) {
            $this->render('auth/login', [
                'mensagemErro' => 'E-mail ou senha incorretos. Por favor, verifique suas credenciais.',
                'email' => $email,
            ], 'layout/auth');
            return;
        }
        // Registra o login na sessão com expiração
        AuthGuard::login($usuario);
        $this->flash('sucesso', "Olá, {$usuario['nome']}! Sessão iniciada com sucesso.");
        $this->redirect('/');
    }

      /**
     * Encerra a sessão do usuário.
     */
    public function logout(): void
    {
        AuthGuard::logout();
        $this->redirect('/login?sucesso=logout');
    }
}