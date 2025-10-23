<?php
// Local: app/Http/Middleware/CheckRoleDoador.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importar Auth
use Symfony\Component\HttpFoundation\Response;

class CheckRoleDoador
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Verifica se o utilizador está logado E se o seu 'role' é 'doador'
        if (Auth::check() && Auth::user()->role === 'doador') {
            // 2. Se for, permite que o pedido continue
            return $next($request);
        }

        // 3. Se não for, redireciona-o para a 'home'
        return redirect()->route('home');
    }
}