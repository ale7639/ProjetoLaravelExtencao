<?php
// Local: database/migrations/...._create_doacoes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doacoes', function (Blueprint $table) {
            $table->id();

            // ID da instituição que recebeu a doação
            $table->foreignId('instituicao_id')->constrained('users');

            // ID do doador (se ele for cadastrado no sistema)
            // nullable() significa que pode ficar em branco (doador anônimo)
            $table->foreignId('doador_id')->nullable()->constrained('users');

            // Caso seja um doador não cadastrado, guardamos os dados dele
            // Campos baseados no protótipo "Registro de Doação" [cite: 118, 119, 120]
            $table->string('doador_nome')->nullable();
            $table->string('doador_telefone')->nullable();
            $table->string('doador_endereco')->nullable();

            // Descrição dos itens doados [cite: 52, 78]
            $table->text('itens_doados'); // (Ex: "10 livros, 5 cadernos")

            // Data da doação [cite: 78]
            $table->date('data_doacao');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doacoes');
    }
};