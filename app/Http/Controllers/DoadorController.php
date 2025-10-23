<?php
// Local: app/Http/Controllers/DoadorController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;      
use App\Models\Doacao;    
use Illuminate\Support\Facades\Auth;

class DoadorController extends Controller
{
    /**
     * Mostra o dashboard do doador.
     */
    public function index()
    {
        // (Este método já existe)
        return view('doador.dashboard');
    }

    /**
     * Mostra o formulário para o doador registrar uma nova doação.
     */
    public function createDoacao()
    {
        // 1. Buscar todas as instituições registadas
        $instituicoes = User::where('role', 'instituicao')->orderBy('name')->get();

        // 2. Retornar a view do formulário, passando a lista de instituições
        return view('doador.create_doacao', compact('instituicoes'));
    }

    /**
     * Salva a nova doação (feita pelo doador) no banco de dados.
     */
    public function storeDoacao(Request $request)
    {
        // 1. Validar os dados
        $request->validate([
            // 'instituicao_id' é obrigatório e deve existir na tabela 'users'
            'instituicao_id' => 'required|exists:users,id', 
            'itens_doados' => 'required|string',
            'data_doacao' => 'required|date',
        ]);

        // 2. Salvar no banco (Tabela 'doacoes')
        Doacao::create([
            'doador_id' => Auth::id(), // ID do Doador logado
            'instituicao_id' => $request->instituicao_id, // ID da Instituição escolhida
            'itens_doados' => $request->itens_doados,
            'data_doacao' => $request->data_doacao,

            // Campos 'doador_nome', 'telefone', etc., ficam NULOS
            // porque o doador está registado.
        ]);

        // 3. Redirecionar para o Dashboard do Doador com mensagem
        return redirect()->route('doador.dashboard')
                         ->with('success', 'Doação registrada com sucesso!');
    }

    public function historico()
    {
        // 1. Pega o ID do doador logado
        $doadorId = Auth::id();

        // 2. Busca no banco de dados todas as doações
        //    filtrando pelo ID do doador
        $doacoes = Doacao::where('doador_id', $doadorId)
                         ->with('instituicao') // Carrega a instituição relacionada
                         ->orderBy('data_doacao', 'desc') // Ordena pelas mais recentes
                         ->get();

        // 3. Retorna a view 'doador.historico' e passa a variável $doacoes
        return view('doador.historico', compact('doacoes'));
    }
}