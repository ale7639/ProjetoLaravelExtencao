<?php
// Local: routes/web.php

use Illuminate\Support\Facades\Route;

// Imports de todos os Controllers que estamos a usar
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\DoacaoController;
use App\Http\Controllers\DoadorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstituicaoDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Rota Pública Principal ---
Route::get('/', function () {
    return view('welcome');
});

// --- Rota de Redirecionamento Pós-Login ---
// 'verified' REMOVIDO DAQUI
Route::get('/home', [HomeController::class, 'index'])
     ->middleware(['auth'])
     ->name('home');

// --- Rota de Perfil (Comum a todos) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// =========================================================================
// --- GRUPO DE ROTAS DA INSTITUIÇÃO ---
// =========================================================================
// 'verified' REMOVIDO DAQUI
Route::middleware(['auth', 'role.instituicao'])->group(function () { // <-- VERIFIQUE ISTO
    
    // Dashboard principal da Instituição
    Route::get('/dashboard', [InstituicaoDashboardController::class, 'index'])
         ->name('dashboard');

    // Grupo de rotas para o Estoque
    Route::prefix('estoque')->name('estoque.')->group(function () {
        Route::get('/', [EstoqueController::class, 'index'])->name('index');
        Route::get('/create', [EstoqueController::class, 'create'])->name('create');
        Route::post('/', [EstoqueController::class, 'store'])->name('store');
        Route::get('/{estoque}/edit', [EstoqueController::class, 'edit'])->name('edit');
        Route::put('/{estoque}', [EstoqueController::class, 'update'])->name('update');
        Route::delete('/{estoque}', [EstoqueController::class, 'destroy'])->name('destroy');
    });

    // Grupo de rotas para Doações (Recebidas pela Instituição)
    Route::prefix('doacoes')->name('doacoes.')->group(function () {
        Route::get('/', [DoacaoController::class, 'index'])->name('index');
        Route::get('/create', [DoacaoController::class, 'create'])->name('create');
        Route::post('/', [DoacaoController::class, 'store'])->name('store');
    });

});


// =========================================================================
// --- GRUPO DE ROTAS DO DOADOR ---
// =========================================================================
// 'verified' REMOVIDO DAQUI
Route::middleware(['auth', 'role.doador'])->group(function () {
    
    // Dashboard principal do Doador
    Route::get('/doador/dashboard', [DoadorController::class, 'index'])
         ->name('doador.dashboard');

    // Formulário para o Doador registar uma doação
    Route::get('/doador/doacoes/create', [DoadorController::class, 'createDoacao'])
         ->name('doador.doacoes.create');

    // Salvar a doação feita pelo Doador
    Route::post('/doador/doacoes', [DoadorController::class, 'storeDoacao'])
         ->name('doador.doacoes.store');
    
    // Página de histórico de doações do Doador
    Route::get('/doador/historico', [DoadorController::class, 'historico'])
         ->name('doador.historico');
    
});


// --- Ficheiro de Rotas de Autenticação ---
require __DIR__.'/auth.php';