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
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'role' => ['required', 'string', Rule::in(['doador', 'instituicao'])],
            'name' => ['required', 'string', 'max:255'],
            'documento' => [
                Rule::requiredIf($request->role == 'instituicao'),
                'nullable',
                'string',
                'max:255',
                'unique:users'
            ],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'telefone' => ['nullable', 'string', 'max:255'],
            'endereco' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'documento' => $request->documento,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}