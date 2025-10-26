<?php
// Local: app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'instituicao') {
            return redirect()->route('dashboard');
        }
        if ($user->role === 'doador') {
            return redirect()->route('doador.dashboard');
        }
        return redirect('/');
    }
}