<?php
// Local: app/Http/Middleware/CheckRoleDoador.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleDoador
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'doador') {
            return $next($request);
        }
        return redirect()->route('home');
    }
}