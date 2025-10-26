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
            
            $table->string('name'); 
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // --- Campos Adicionados ---
            $table->string('documento')->unique()->nullable(); // CPF ou CNPJ
            $table->string('telefone')->nullable();
            $table->string('endereco')->nullable();
            $table->string('role')->default('doador'); // 'doador' ou 'instituicao'
            // --- Fim dos Campos Adicionados ---

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};