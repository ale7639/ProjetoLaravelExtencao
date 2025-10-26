<?php
// Local: app/Http/Middleware/CheckRoleInstituicao.php

namespace App\Http\Middleware; // <-- VERIFIQUE ISTO

use Closure;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleInstituicao // <-- VERIFIQUE ISTO
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Esta lógica parece correta, o problema é o Laravel "encontrar" o ficheiro
        if (Auth::check() && Auth::user()->role === 'instituicao') {
            return $next($request);
        }

        return redirect()->route('home');
    }
}