<?php
// Local: app/Http/Controllers/DoadorController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doacao;
use Illuminate\Support\Facades\Auth;

class DoadorController extends Controller
{
    public function index()
    {
        return view('doador.dashboard');
    }

    public function createDoacao()
    {
        $instituicoes = User::where('role', 'instituicao')->orderBy('name')->get();
        return view('doador.create_doacao', compact('instituicoes'));
    }

    public function storeDoacao(Request $request)
    {
        $request->validate([
            'instituicao_id' => 'required|exists:users,id',
            'itens_doados' => 'required|string',
            'data_doacao' => 'required|date',
        ]);
        Doacao::create([
            'doador_id' => Auth::id(),
            'instituicao_id' => $request->instituicao_id,
            'itens_doados' => $request->itens_doados,
            'data_doacao' => $request->data_doacao,
        ]);
        return redirect()->route('doador.dashboard')
                         ->with('success', 'Doação registrada com sucesso!');
    }

    public function historico()
    {
        $doadorId = Auth::id();
        $doacoes = Doacao::where('doador_id', $doadorId)
                         ->with('instituicao')
                         ->orderBy('data_doacao', 'desc')
                         ->get();
        return view('doador.historico', compact('doacoes'));
    }
}