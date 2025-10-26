<?php
// Local: app/Http/Controllers/EstoqueController.php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstoqueController extends Controller
{
    public function index()
    {
        $instituicaoId = Auth::id();
        $estoques = Estoque::where('instituicao_id', $instituicaoId)
                          ->orderBy('created_at', 'desc')
                          ->get();
        return view('estoque.index', compact('estoques'));
    }

    public function create()
    {
        return view('estoque.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_nome' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:0',
            'data_recebimento' => 'required|date',
            'status' => 'required|string',
        ]);
        Estoque::create([
            'instituicao_id' => Auth::id(),
            'item_nome' => $request->item_nome,
            'quantidade' => $request->quantidade,
            'data_recebimento' => $request->data_recebimento,
            'status' => $request->status,
        ]);
        return redirect()->route('estoque.index')
                         ->with('success', 'Item adicionado ao estoque com sucesso!');
    }

    public function edit(Estoque $estoque)
    {
        if ($estoque->instituicao_id !== Auth::id()) {
            abort(403);
        }
        return view('estoque.edit', compact('estoque'));
    }

    public function update(Request $request, Estoque $estoque)
    {
        if ($estoque->instituicao_id !== Auth::id()) {
            abort(403);
        }
        $request->validate([
            'item_nome' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:0',
            'data_recebimento' => 'required|date',
            'status' => 'required|string',
        ]);
        $estoque->update($request->all());
        return redirect()->route('estoque.index')
                         ->with('success', 'Item atualizado com sucesso!');
    }

    public function destroy(Estoque $estoque)
    {
        if ($estoque->instituicao_id !== Auth::id()) {
            abort(403);
        }
        $estoque->delete();
        return redirect()->route('estoque.index')
                         ->with('success', 'Item apagado com sucesso!');
    }
}