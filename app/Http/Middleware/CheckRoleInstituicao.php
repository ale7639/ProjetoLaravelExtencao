<?php
// Local: app/Http/Middleware/CheckRoleInstituicao.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importar Auth
use Symfony\Component\HttpFoundation\Response;

class CheckRoleInstituicao
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Verifica se o utilizador está logado E se o seu 'role' é 'instituicao'
        if (Auth::check() && Auth::user()->role === 'instituicao') {
            // 2. Se for, permite que o pedido continue
            return $next($request);
        }

        // 3. Se não for, redireciona-o para a 'home' (que o enviará para o dashboard correto)
        return redirect()->route('home');
    }
}