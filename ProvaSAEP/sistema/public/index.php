<?php

declare(strict_types=1);

/**
 * Ponto de entrada único da aplicação (Front Controller).
 * Todas as requisições passam por este arquivo para roteamento e carregamento.
 */

//Carregamento do AutoLoader PSR-4 gerado pelo Composer

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Controllers\AgendamentoController;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\PetController;
use App\Controllers\TutorController;
use App\Core\Roteador;

 // Inicialização do roteador
$roteador = new Roteador();
// =====================================================================
// DEFINIÇÃO DAS ROTAS DO SISTEMA
// =====================================================================
// Rotas de Autenticação e Sessão
$roteador->get('/login', AuthController::class, 'login');
$roteador->post('/login', AuthController::class, 'autenticar');
$roteador->get('/logout', AuthController::class, 'logout');
// Tela Principal (Dashboard)
$roteador->get('/', HomeController::class, 'index');
// Módulo de Tutores (com busca, edição e proteção de CPF via LGPD)
$roteador->get('/tutores', TutorController::class, 'index');
$roteador->get('/tutores/cadastrar', TutorController::class, 'cadastrar');
$roteador->post('/tutores/salvar', TutorController::class, 'salvar');
$roteador->get('/tutores/editar', TutorController::class, 'editar');
$roteador->post('/tutores/atualizar', TutorController::class, 'atualizar');
// Módulo de Pets (com vinculação obrigatória de tutor)
$roteador->get('/pets', PetController::class, 'index');
$roteador->get('/pets/cadastrar', PetController::class, 'cadastrar');
$roteador->post('/pets/salvar', PetController::class, 'salvar');
// Módulo de Agendamentos (com ordenação cronológica e alteração de data)
$roteador->get('/agendamentos', AgendamentoController::class, 'index');
$roteador->get('/agendamentos/cadastrar', AgendamentoController::class, 'cadastrar');
$roteador->post('/agendamentos/salvar', AgendamentoController::class, 'salvar');
$roteador->get('/agendamentos/editar', AgendamentoController::class, 'editar');
$roteador->post('/agendamentos/atualizar-data', AgendamentoController::class, 'atualizarData');
// Executa o despacho da rota solicitada
$roteador->despachar();