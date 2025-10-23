<?php
// Local: app/Http/Controllers/InstituicaoDashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importar Auth
use App\Models\User;      // Importar User
use App\Models\Estoque;   // Importar Estoque
use App\Models\Doacao;    // Importar Doacao

class InstituicaoDashboardController extends Controller
{
    /**
     * Mostra o dashboard da instituição com estatísticas.
     */
    public function index()
    {
        // Pega o ID da instituição logada
        $instituicaoId = Auth::id();

        // 1. Calcular o Total de Itens no Estoque [cite: 105-106]
        // Soma a coluna 'quantidade' de todos os itens da instituição
        $totalEstoque = Estoque::where('instituicao_id', $instituicaoId)->sum('quantidade');

        // 2. Calcular o Total de Doadores Registados [cite: 112-113]
        // Conta todos os utilizadores com 'role' = 'doador'
        $totalDoadores = User::where('role', 'doador')->count();

        // 3. Buscar as Últimas Doações Recebidas 
        // Pega as 5 últimas doações (seja de doador anónimo ou registado)
        $ultimasDoacoes = Doacao::where('instituicao_id', $instituicaoId)
                                ->with('doador') // Carrega o doador (se houver)
                                ->orderBy('data_doacao', 'desc')
                                ->limit(5)
                                ->get();

        // 4. Envia todos os dados para a view
        return view('dashboard', [
            'totalEstoque' => $totalEstoque,
            'totalDoadores' => $totalDoadores,
            'ultimasDoacoes' => $ultimasDoacoes,
        ]);
    }
}