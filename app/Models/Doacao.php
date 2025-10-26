<?php
// Local: app/Models/Doacao.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doacao extends Model
{
    use HasFactory;

    protected $table = 'doacoes';
    
    protected $fillable = [
        'instituicao_id',
        'doador_id',
        'doador_nome',
        'doador_telefone',
        'doador_endereco',
        'itens_doados',
        'data_doacao',
    ];
    public function doador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doador_id');
    }
    public function instituicao(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instituicao_id');
    }
}