<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiLivroController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| As rotas aqui já recebem automaticamente o prefixo "/api"
| e o middleware "api" (sem sessão, sem CSRF).
|
*/

Route::prefix('livros')->group(function () {
    Route::get('/', [ApiLivroController::class, 'index']);     // GET /api/livros
    Route::get('/{id}', [ApiLivroController::class, 'show']);  // GET /api/livros/{id}
    Route::post('/', [ApiLivroController::class, 'store']);    // POST /api/livros
    Route::delete('/{id}', [ApiLivroController::class, 'destroy']); // DELETE /api/livros/{id}
});
