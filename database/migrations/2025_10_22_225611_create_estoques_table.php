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

            // Chave estrangeira para ligar o item à instituição (User)
            $table->foreignId('instituicao_id')->constrained('users');
            
            $table->string('item_nome');
            $table->integer('quantidade');
            $table->string('status')->default('OKAY');
            $table->date('data_recebimento');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estoques');
    }
};