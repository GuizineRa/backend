<?php
namespace App\Controllers;
use App\Core\AuthGuard;
use App\Models\Agendamento;
use App\Models\Pet;
use App\Models\Tutor;
/**
 * Controller da tela principal (Dashboard).
 */
class HomeController extends Controller
{
    /**
     * Exibe a tela principal com dados do usuário logado, resumo e links para os módulos.
     */
    public function index(): void
    {
        AuthGuard::verificarAutenticacao();
        $usuario = AuthGuard::usuario();
        $totalTutores = Tutor::contar();
        $totalPets = Pet::contar();
        $totalAgendamentos = Agendamento::contar();
        $proximosAgendamentos = array_slice(Agendamento::listarOrdenadoPorData(), 0, 5);
        $this->render('home/index', [
            'usuario' => $usuario,
            'totalTutores' => $totalTutores,
            'totalPets' => $totalPets,
            'totalAgendamentos' => $totalAgendamentos,
            'proximosAgendamentos' => $proximosAgendamentos,
        ]);
    }
}