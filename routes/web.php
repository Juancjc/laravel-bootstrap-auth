<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\Api\ApiLivroController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //rotas de criar libro e mostrar
    Route::get('/livro/create', [LivroController::class, 'create'])->name('livro.create');
    Route::post('/livro/create', [LivroController::class, 'store'])->name('livro.store');
    Route::get('/livro', [LivroController::class, 'index'])->name('livro.index');
    Route::get('/livro/{id}', [LivroController::class, 'edit'])->name('livro.edit');
    Route::put('/livro/{id}', [LivroController::class, 'update'])->name('livro.update');
    Route::delete('/livro/{id}', [LivroController::class, 'destroy'])->name('livro.destroy');
});

require __DIR__.'/auth.php';
