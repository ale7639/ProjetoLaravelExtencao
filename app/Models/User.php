<?php
// Local: app/Models/User.php

namespace App\Models;

// O import 'MustVerifyEmail' foi removido
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

// 'implements MustVerifyEmail' FOI REMOVIDO DAQUI
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'documento',
        'telefone',
        'endereco',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Define a relação: um usuário (instituição) pode ter muitos itens de estoque.
     */
    public function estoques(): HasMany
    {
        return $this->hasMany(Estoque::class, 'instituicao_id');
    }
}