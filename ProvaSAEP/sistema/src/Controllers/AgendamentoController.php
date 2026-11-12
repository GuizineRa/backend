<?php
namespace App\Controllers;
use App\Core\AuthGuard;
use App\Models\Agendamento;
use App\Models\Pet;
/**
 * Controller responsável pelos agendamentos de consultas.
 * Regras:
 * - Listagem ordenada por data com detalhes do pet e do tutor.
 * - Capacidade de alterar a data de agendamentos existentes.
 */
class AgendamentoController extends Controller
{
    /**
     * Lista os agendamentos ordenados por data cronológica crescente.
     */
    public function index(): void
    {
        AuthGuard::verificarAutenticacao();
        $agendamentos = Agendamento::listarOrdenadoPorData();
        $this->render('agendamentos/index', [
            'agendamentos' => $agendamentos,
        ]);
    }
    /**
     * Exibe o formulário para cadastro de um novo agendamento.
     */
    public function cadastrar(): void
    {
        AuthGuard::verificarAutenticacao();
        $pets = Pet::listar();

            if (empty($pets)) {
            $this->flash('erro', 'Para agendar uma consulta, é necessário ter pelo menos um pet cadastrado.');
            $this->redirect('/pets/cadastrar');
        }
        $this->render('agendamentos/cadastrar', [
            'pets' => $pets,
            'erros' => [],
            'dados' => [],
        ]);
    }

     /**
     * Salva um novo agendamento de consulta.
     */
    public function salvar(): void
    {
        AuthGuard::verificarAutenticacao();
        $petId = (int)($_POST['pet_id'] ?? 0);
        $dataAgendamento = trim($_POST['data_agendamento'] ?? '');
        $motivo = trim($_POST['motivo'] ?? '');
        $status = trim($_POST['status'] ?? 'Agendado');
        $erros = [];
        if ($petId <= 0) {
            $erros[] = 'Selecione o pet para o agendamento.';
        }
        if (empty($dataAgendamento)) {
            $erros[] = 'A data e hora da consulta são obrigatórias.';
        }
        if (empty($motivo)) {
            $erros[] = 'O motivo da consulta é obrigatório.';
        }
        if (!empty($erros)) {
            $pets = Pet::listar();
            $this->render('agendamentos/cadastrar', [
                'pets' => $pets,
                'erros' => $erros,
                'dados' => $_POST,
            ]);
            return;
        }

          // Formata data do datetime-local para padrão SQL se necessário
        $dataFormatada = str_replace('T', ' ', $dataAgendamento);
        try {
            Agendamento::criar($petId, $dataFormatada, $motivo, $status);
            $this->flash('sucesso', 'Consulta agendada com sucesso!');
            $this->redirect('/agendamentos');
        } catch (\Throwable $e) {
            $pets = Pet::listar();
            $this->render('agendamentos/cadastrar', [
                'pets' => $pets,
                'erros' => ['Erro ao criar agendamento: ' . $e->getMessage()],
                'dados' => $_POST,
            ]);
        }
    }
    /**
     * Exibe o formulário específico para alteração da data do agendamento.
     */
    public function editar(): void
    {
        AuthGuard::verificarAutenticacao();
        $id = (int)($_GET['id'] ?? 0);
        $agendamento = Agendamento::buscarPorId($id);
        if (!$agendamento) {
            $this->flash('erro', 'Agendamento não encontrado.');
            $this->redirect('/agendamentos');
        }
        $this->render('agendamentos/editar', [
            'agendamento' => $agendamento,
            'erros' => [],
        ]);
    }

      /**
     * Atualiza a data de um agendamento existente no banco de dados.
     */
    public function atualizarData(): void
    {
        AuthGuard::verificarAutenticacao();
        $id = (int)($_POST['id'] ?? 0);
        $novaData = trim($_POST['data_agendamento'] ?? '');
        $agendamento = Agendamento::buscarPorId($id);
        if (!$agendamento) {
            $this->flash('erro', 'Agendamento não encontrado para alteração.');
            $this->redirect('/agendamentos');
        }
        if (empty($novaData)) {
            $this->render('agendamentos/editar', [
                'agendamento' => $agendamento,
                'erros' => ['Informe a nova data e horário para a consulta.'],
            ]);
            return;
        }
        $dataFormatada = str_replace('T', ' ', $novaData);
        try {
            Agendamento::atualizarData($id, $dataFormatada);
            $this->flash('sucesso', 'Data do agendamento alterada com sucesso!');
            $this->redirect('/agendamentos');
        } catch (\Throwable $e) {
            $this->render('agendamentos/editar', [
                'agendamento' => $agendamento,
                'erros' => ['Erro ao salvar nova data: ' . $e->getMessage()],
            ]);
        }
    }
}