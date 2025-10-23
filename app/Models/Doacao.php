<?php
// Local: app/Models/Doacao.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- ADICIONAR IMPORT

class Doacao extends Model
{
    use HasFactory;

    // ... (propriedade $fillable já existente)
    protected $fillable = [
        'instituicao_id',
        'doador_id',
        'doador_nome',
        'doador_telefone',
        'doador_endereco',
        'itens_doados',
        'data_doacao',
    ];

    // --- ADICIONE ESTES MÉTODOS ---

    /**
     * Define a relação: Uma doação pertence a um Doador (User).
     */
    public function doador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doador_id');
    }

    /**
     * Define a relação: Uma doação pertence a uma Instituição (User).
     */
    public function instituicao(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instituicao_id');
    }
}