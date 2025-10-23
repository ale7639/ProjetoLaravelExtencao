<?php
// Local: app/Http/Controllers/Auth/RegisteredUserController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. VALIDAÇÃO
        $request->validate([
            // Valida o 'role' para ser 'doador' ou 'instituicao'
            'role' => ['required', 'string', Rule::in(['doador', 'instituicao'])],

            'name' => ['required', 'string', 'max:255'],

            // Validação condicional para 'documento' (CNPJ)
            // É obrigatório APENAS SE o role for 'instituicao'
            'documento' => [
                Rule::requiredIf($request->role == 'instituicao'),
                'nullable', // Permite ser nulo se não for instituição
                'string',
                'max:255',
                'unique:users' // Garante que o documento é único
            ],

            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'telefone' => ['nullable', 'string', 'max:255'],
            'endereco' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. CRIAÇÃO DO UTILIZADOR
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            // Salvar os novos campos
            'role' => $request->role,
            'documento' => $request->documento,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // 3. REDIRECIONAMENTO (usar o provedor de rotas padrão)
        return redirect(RouteServiceProvider::HOME);
    }
}