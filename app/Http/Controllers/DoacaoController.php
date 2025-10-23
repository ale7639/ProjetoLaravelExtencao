<?php
// Local: app/Http/Controllers/DoacaoController.php

namespace App\Http\Controllers;

use App\Models\Doacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoacaoController extends Controller
{
    /**
     * Mostra a lista de doações recebidas.
     */
    public function index()
    {
        // 1. Busca no banco de dados todas as doações
        //    filtrando pela instituição logada (Auth::id())
        $doacoes = Doacao::where('instituicao_id', Auth::id())
                         ->orderBy('data_doacao', 'desc') // Ordena pelas mais recentes
                         ->get(); // Pega os resultados

        // 2. Retorna a view 'doacoes.index' e passa a variável $doacoes para ela
        return view('doacoes.index', compact('doacoes'));
    }

    /**
     * Mostra o formulário para registrar uma nova doação.
     */
    public function create()
    {
        // (Este método já está correto)
        return view('doacoes.create');
    }

    /**
     * Salva a nova doação no banco de dados.
     */
    public function store(Request $request)
    {
        // (Este método já está correto)
        $request->validate([
            'doador_nome' => 'required|string|max:255',
            'doador_telefone' => 'nullable|string|max:20',
            'doador_endereco' => 'nullable|string|max:255',
            'data_doacao' => 'required|date',
            'itens_doados' => 'required|string',
        ]);

        Doacao::create([
            'instituicao_id' => Auth::id(),
            'doador_nome' => $request->doador_nome,
            'doador_telefone' => $request->doador_telefone,
            'doador_endereco' => $request->doador_endereco,
            'data_doacao' => $request->data_doacao,
            'itens_doados' => $request->itens_doados,
        ]);

        return redirect()->route('dashboard')
                         ->with('success', 'Doação registrada com sucesso!');
    }
}