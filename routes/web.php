<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\DoacaoController;
use App\Http\Controllers\DoadorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstituicaoDashboardController;



// Local: routes/web.php

// ... (imports)


Route::get('/dashboard', [InstituicaoDashboardController::class, 'index'])
     ->middleware(['auth', 'verified', 'role.instituicao'])
     ->name('dashboard');

Route::middleware('auth')->group(function () {
    // ... (rotas de profile e doacoes)

    // Grupo de rotas para o Estoque
    Route::prefix('estoque')->name('estoque.')->group(function () {

        // (Rotas existentes)
        Route::get('/', [EstoqueController::class, 'index'])->name('index');
        Route::get('/create', [EstoqueController::class, 'create'])->name('create');
        Route::post('/', [EstoqueController::class, 'store'])->name('store');

        // --- ADICIONE ESTAS LINHAS ---

        // Rota para mostrar o formulário de edição (ex: /estoque/5/edit)
        // {estoque} é um parâmetro dinâmico (o ID do item)
        Route::get('/{estoque}/edit', [EstoqueController::class, 'edit'])->name('edit');

        // Rota para salvar as alterações (método PUT)
        Route::put('/{estoque}', [EstoqueController::class, 'update'])->name('update');

        // Rota para deletar o item (método DELETE)
        Route::delete('/{estoque}', [EstoqueController::class, 'destroy'])->name('destroy');


        Route::get('/doador/dashboard', [DoadorController::class, 'index'])
     ->middleware(['auth', 'verified'])
     ->name('doador.dashboard');

     Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- ADICIONE ESTA ROTA DE REDIRECIONAMENTO ---
Route::get('/home', [HomeController::class, 'index'])
     ->middleware(['auth', 'verified'])
     ->name('home');

        // --- FIM DA ADIÇÃO ---
    });

    // ... (rotas de doacoes)
});


Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard do Doador (Já existe)
    Route::get('/doador/dashboard', [DoadorController::class, 'index'])
         ->name('doador.dashboard');

    // --- ADICIONE ESTAS LINHAS ---

    // Rota para mostrar o formulário de Adicionar Doação (Doador)
    Route::get('/doador/doacoes/create', [DoadorController::class, 'createDoacao'])
         ->name('doador.doacoes.create');

    // Rota para salvar a nova doação (Doador)
    Route::post('/doador/doacoes', [DoadorController::class, 'storeDoacao'])
         ->name('doador.doacoes.store');

    // (Futuramente, a rota do Histórico do Doador virá aqui)



    Route::middleware(['auth', 'verified'])->group(function () {

    // ... (rotas doador.dashboard, doador.doacoes.create, doador.doacoes.store)

    // --- ADICIONE ESTA LINHA ---
    // Rota para o Histórico de Doações (Doador)
    Route::get('/doador/historico', [DoadorController::class, 'historico'])
         ->name('doador.historico');

});



    Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role.instituicao']) // <-- ADICIONAR AQUI
   ->name('dashboard');

// ROTA DE REDIRECIONAMENTO (não precisa de proteção de role)
Route::get('/home', [HomeController::class, 'index'])
     ->middleware(['auth', 'verified'])
     ->name('home');

// ROTA DE PERFIL (não precisa de proteção de role, é para todos)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// --- Rotas da INSTITUIÇÃO ---
// Adicionar o middleware 'role.instituicao' a este grupo
Route::middleware(['auth', 'verified', 'role.instituicao'])->group(function () {

    // Grupo de rotas para o Estoque
    Route::prefix('estoque')->name('estoque.')->group(function () {
        Route::get('/', [EstoqueController::class, 'index'])->name('index');
        Route::get('/create', [EstoqueController::class, 'create'])->name('create');
        Route::post('/', [EstoqueController::class, 'store'])->name('store');
        Route::get('/{estoque}/edit', [EstoqueController::class, 'edit'])->name('edit');
        Route::put('/{estoque}', [EstoqueController::class, 'update'])->name('update');
        Route::delete('/{estoque}', [EstoqueController::class, 'destroy'])->name('destroy');
    });

    // Grupo de rotas para Doações (da Instituição)
    Route::prefix('doacoes')->name('doacoes.')->group(function () {
        Route::get('/', [DoacaoController::class, 'index'])->name('index');
        Route::get('/create', [DoacaoController::class, 'create'])->name('create');
        Route::post('/', [DoacaoController::class, 'store'])->name('store');
    });

});


// --- Rotas do DOADOR ---
// Adicionar o middleware 'role.doador' a este grupo
Route::middleware(['auth', 'verified', 'role.doador'])->group(function () {

    Route::get('/doador/dashboard', [DoadorController::class, 'index'])
         ->name('doador.dashboard');

    Route::get('/doador/doacoes/create', [DoadorController::class, 'createDoacao'])
         ->name('doador.doacoes.create');

    Route::post('/doador/doacoes', [DoadorController::class, 'storeDoacao'])
         ->name('doador.doacoes.store');

    Route::get('/doador/historico', [DoadorController::class, 'historico'])
         ->name('doador.historico');

});

});

require __DIR__.'/auth.php';