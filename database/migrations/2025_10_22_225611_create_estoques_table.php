<?php
// Local: database/migrations/...._create_estoques_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estoques', function (Blueprint $table) {
            $table->id();

            // Chave estrangeira para ligar o item à instituição (que é um User)
            $table->foreignId('instituicao_id')->constrained('users');

            // Itens doados (ex: arroz, livros, canetas) [cite: 41, 60, 77]
            $table->string('item_nome');

            // Quantidade do item [cite: 42, 77]
            $table->integer('quantidade');

            // Status do item (OKAY, INVALIDO, etc) [cite: 43, 77]
            $table->string('status')->default('OKAY');

            // Data de recebimento 
            $table->date('data_recebimento');

            $table->timestamps(); // (created_at e updated_at)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estoques');
    }
};