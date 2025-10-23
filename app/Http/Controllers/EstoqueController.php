<?php
// Local: app/Http/Controllers/EstoqueController.php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Precisamos validar que o usuário só pode editar/apagar os *seus* itens
use Illuminate\Auth\Access\AuthorizationException;


class EstoqueController extends Controller
{
    // ... (métodos index, create, store já existentes)
    public function index() { /* ... */ }
    public function create() { /* ... */ }
    public function store(Request $request) { /* ... */ }


    /**
     * Mostra o formulário para editar um item de estoque.
     * $estoque é injetado automaticamente pelo Laravel (Route Model Binding)
     */
    public function edit(Estoque $estoque)
    {
        // Verificação de segurança: O item pertence à instituição logada?
        if ($estoque->instituicao_id !== Auth::id()) {
            abort(403); // Proibido (Forbidden)
        }

        // Retorna a view de edição e passa o item
        return view('estoque.edit', compact('estoque'));
    }

    /**
     * Atualiza o item de estoque no banco de dados.
     */
    public function update(Request $request, Estoque $estoque)
    {
        // Verificação de segurança
        if ($estoque->instituicao_id !== Auth::id()) {
            abort(403);
        }

        // 1. Validar os dados (igual ao store)
        $request->validate([
            'item_nome' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:0',
            'data_recebimento' => 'required|date',
            'status' => 'required|string',
        ]);

        // 2. Atualizar o item no banco com os dados validados
        $estoque->update([
            'item_nome' => $request->item_nome,
            'quantidade' => $request->quantidade,
            'data_recebimento' => $request->data_recebimento,
            'status' => $request->status,
        ]);

        // 3. Redirecionar de volta para a lista com mensagem de sucesso
        return redirect()->route('estoque.index')
                         ->with('success', 'Item atualizado com sucesso!');
    }

    /**
     * Remove o item de estoque do banco de dados.
     */
    public function destroy(Estoque $estoque)
    {
        // Verificação de segurança
        if ($estoque->instituicao_id !== Auth::id()) {
            abort(403);
        }

        // 1. Apagar o item
        $estoque->delete();

        // 2. Redirecionar de volta para a lista com mensagem de sucesso
        return redirect()->route('estoque.index')
                         ->with('success', 'Item apagado com sucesso!');
    }
}