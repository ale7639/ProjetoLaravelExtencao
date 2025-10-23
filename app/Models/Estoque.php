<?php
// Local: app/Models/Estoque.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Importar

class Estoque extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'instituicao_id', // <-- Importante
        'item_nome',
        'quantidade',
        'status',
        'data_recebimento',
    ];

    /**
     * Define a relação: um item de estoque pertence a uma instituição (User).
     */
    public function instituicao(): BelongsTo
    {
        // O ID da instituição na tabela 'estoques' é a 'instituicao_id'
        return $this->belongsTo(User::class, 'instituicao_id');
    }
}