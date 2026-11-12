<?php
namespace App\Controllers;
use App\Core\AuthGuard;
use App\Models\Tutor;
/**
 * Controller responsável pela gestão e busca de tutores, com proteção criptográfica de CPF (LGPD).
 */
class TutorController extends Controller
{
    /**
     * Lista tutores com suporte a busca por nome ou CPF criptografado.
     */
    public function index(): void
    {
        AuthGuard::verificarAutenticacao();
        $busca = $_GET['busca'] ?? null;
        $tutores = Tutor::listar($busca);
        $this->render('tutores/index', [
            'tutores' => $tutores,
            'busca' => $busca,
        ]);
    }
    /**
     * Exibe o formulário de cadastro de novo tutor.
     */
    public function cadastrar(): void
    {
        AuthGuard::verificarAutenticacao();
        $this->render('tutores/cadastrar', [
            'erros' => [],
            'dados' => [],
        ]);
    }
    /**
     * Processa e persiste o cadastro de um novo tutor.
     */
    public function salvar(): void
    {
                AuthGuard::verificarAutenticacao();
        $nome = trim($_POST['nome'] ?? '');
        $cpf = trim($_POST['cpf'] ?? '');
        $telefone = trim($_POST['telefone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $erros = [];
        if (empty($nome)) {
            $erros[] = 'O nome do tutor é obrigatório.';
        }
        if (empty($cpf)) {
            $erros[] = 'O CPF do tutor é obrigatório para cumprimento da LGPD.';
        }
        if (empty($telefone)) {
            $erros[] = 'O telefone de contato é obrigatório.';
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = 'Informe um e-mail válido.';
        }
        if (!empty($erros)) {
            $this->render('tutores/cadastrar', [
                'erros' => $erros,
                'dados' => $_POST,
            ]);
            return;
        }
        try {
            Tutor::criar($nome, $cpf, $telefone, $email);
            $this->flash('sucesso', "Tutor '{$nome}' cadastrado com sucesso! CPF armazenado sob criptografia AES-256.");
            $this->redirect('/tutores');
        } catch (\Throwable $e) {
            $this->render('tutores/cadastrar', [
                'erros' => ['Erro ao salvar no banco de dados: ' . $e->getMessage()],
                'dados' => $_POST,
            ]);
        }
    }

     /**
     * Exibe o formulário de edição de um tutor existente.
     */
    public function editar(): void
    {
        AuthGuard::verificarAutenticacao();
        $id = (int)($_GET['id'] ?? 0);
        $tutor = Tutor::buscarPorId($id);
        if (!$tutor) {
            $this->flash('erro', 'Tutor não encontrado.');
            $this->redirect('/tutores');
        }
        $this->render('tutores/editar', [
            'tutor' => $tutor,
            'erros' => [],
        ]);
    }
    /**
     * Salva as alterações de um tutor no banco de dados.
     */
    public function atualizar(): void
    {
        AuthGuard::verificarAutenticacao();
        $id = (int)($_POST['id'] ?? 0);
        $nome = trim($_POST['nome'] ?? '');
        $cpf = trim($_POST['cpf'] ?? '');
        $telefone = trim($_POST['telefone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $tutorExistente = Tutor::buscarPorId($id);
        if (!$tutorExistente) {
            $this->flash('erro', 'Tutor não encontrado para atualização.');
            $this->redirect('/tutores');
        }

          $erros = [];
        if (empty($nome)) {
            $erros[] = 'O nome do tutor é obrigatório.';
        }
        if (empty($cpf)) {
            $erros[] = 'O CPF é obrigatório.';
        }
        if (empty($telefone)) {
            $erros[] = 'O telefone é obrigatório.';
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = 'Informe um e-mail válido.';
        }
        if (!empty($erros)) {
            $this->render('tutores/editar', [
                'tutor' => array_merge($tutorExistente, $_POST),
                'erros' => $erros,
            ]);
            return;
        }
        try {
            Tutor::atualizar($id, $nome, $cpf, $telefone, $email);
            $this->flash('sucesso', "Dados do tutor '{$nome}' atualizados com sucesso!");
            $this->redirect('/tutores');
        } catch (\Throwable $e) {
            $this->render('tutores/editar', [
                'tutor' => array_merge($tutorExistente, $_POST),
                'erros' => ['Erro ao atualizar no banco de dados: ' . $e->getMessage()],
            ]);
        }
    }
}