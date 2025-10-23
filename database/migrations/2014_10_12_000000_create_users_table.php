<?php
// Local: database/migrations/...._create_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Campo "Nome completo" [cite: 18] ou "Nome da instituição" [cite: 26]
            $table->string('name'); 

            // Campo "E-mail" [cite: 20, 29]
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            // Campo "Senha" [cite: 34]
            $table->string('password');

            // Campo "CPF/CNPJ" [cite: 19, 27]
            $table->string('documento')->unique()->nullable(); // CPF ou CNPJ

            // Campo "Telefone" [cite: 21, 29]
            $table->string('telefone')->nullable();

            // Campo "Endereço" [cite: 22, 30]
            $table->string('endereco')->nullable();

            // Campo para definir o perfil 
            // 'doador' ou 'instituicao'
            $table->string('role')->default('doador'); 

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};