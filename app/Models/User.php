<?php
// Local: app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// ... (imports)

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'documento',    // <-- ADICIONAR
        'telefone',     // <-- ADICIONAR
        'endereco',     // <-- ADICIONAR
        'role',         // <-- ADICIONAR
    ];

    // ... (resto do model, incluindo o método estoques())
}