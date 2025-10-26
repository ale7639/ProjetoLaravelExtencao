<?php
// Local: app/Models/Estoque.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Estoque extends Model
{
    use HasFactory;
    protected $fillable = [
        'instituicao_id',
        'item_nome',
        'quantidade',
        'status',
        'data_recebimento',
    ];
    public function instituicao(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instituicao_id');
    }
}