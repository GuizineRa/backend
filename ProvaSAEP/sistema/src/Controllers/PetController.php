<?php
namespace App\Controllers;
use App\Core\AuthGuard;
use App\Models\Pet;
use App\Models\Tutor;
/**
 * Controller responsável pela gestão e cadastro de pets.
 * Regra: Todo pet deve obrigatoriamente estar vinculado a um tutor existente.
 */
class PetController extends Controller
{
    /**
     * Lista todos os pets e seus respectivos tutores.
     */
    public function index(): void
    {
        AuthGuard::verificarAutenticacao();
        $pets = Pet::listar();
        $this->render('pets/index', [
            'pets' => $pets,
        ]);
    }
    /**
     * Exibe o formulário de cadastro de pet, carregando os tutores para associação obrigatória.
     */
    public function cadastrar(): void
    {
        AuthGuard::verificarAutenticacao();
        $tutores = Tutor::listar();
        if (empty($tutores)) {
            $this->flash('erro', 'Para cadastrar um pet, é necessário cadastrar pelo menos um tutor previamente.');
            $this->redirect('/tutores/cadastrar');
        }

                $this->render('pets/cadastrar', [
            'tutores' => $tutores,
            'erros' => [],
            'dados' => [],
        ]);
    }
    /**
     * Processa e persiste o cadastro do pet.
     */
    public function salvar(): void
    {
        AuthGuard::verificarAutenticacao();
        $tutorId = (int)($_POST['tutor_id'] ?? 0);
        $nome = trim($_POST['nome'] ?? '');
        $especie = trim($_POST['especie'] ?? '');
        $raca = trim($_POST['raca'] ?? '');
        $dataNascimento = trim($_POST['data_nascimento'] ?? '');
        $erros = [];
        if ($tutorId <= 0) {
            $erros[] = 'A associação com um tutor existente é obrigatória.';
        }
        if (empty($nome)) {
            $erros[] = 'O nome do pet é obrigatório.';
        }
        if (empty($especie)) {
            $erros[] = 'A espécie do animal é obrigatória.';
        }
        if (empty($raca)) {
            $erros[] = 'A raça é obrigatória.';
        }
        if (empty($dataNascimento)) {
            $erros[] = 'A data de nascimento é obrigatória.';
        }

                if (!empty($erros)) {
            $tutores = Tutor::listar();
            $this->render('pets/cadastrar', [
                'tutores' => $tutores,
                'erros' => $erros,
                'dados' => $_POST,
            ]);
            return;
        }
        try {
            Pet::criar($tutorId, $nome, $especie, $raca, $dataNascimento);
            $this->flash('sucesso', "Pet '{$nome}' cadastrado e vinculado ao tutor com sucesso!");
            $this->redirect('/pets');
        } catch (\Throwable $e) {
            $tutores = Tutor::listar();
            $this->render('pets/cadastrar', [
                'tutores' => $tutores,
                'erros' => ['Erro ao cadastrar pet: ' . $e->getMessage()],
                'dados' => $_POST,
            ]);
        }
    }
}