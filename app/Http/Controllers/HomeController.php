<?php
// Local: app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importar Auth

class HomeController extends Controller
{
    /**
     * Redireciona o utilizador com base no seu perfil (role).
     */
    public function index()
    {
        // Pega o utilizador logado
        $user = Auth::user();

        // 1. Se for 'instituicao', vai para o dashboard da instituição
        if ($user->role === 'instituicao') {
            return redirect()->route('dashboard');
        }

        // 2. Se for 'doador', vai para o dashboard do doador
        if ($user->role === 'doador') {
            return redirect()->route('doador.dashboard');
        }

        // 3. (Fallback) Se não tiver perfil, vai para uma página genérica
        //    Isso não deve acontecer, mas é uma boa prática.
        return redirect('/');
    }
}