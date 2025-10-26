<?php
// Local: app/Http/Controllers/DoacaoController.php

namespace App\Http\Controllers;

use App\Models\Doacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoacaoController extends Controller
{
    public function index()
    {
        $doacoes = Doacao::where('instituicao_id', Auth::id())
                         ->orderBy('data_doacao', 'desc')
                         ->get();
        return view('doacoes.index', compact('doacoes'));
    }

    public function create()
    {
        return view('doacoes.create');
    }

    public function store(Request $request)
    {
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