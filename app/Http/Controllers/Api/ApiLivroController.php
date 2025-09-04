<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ApiLivroController extends Controller
{
    public function index(Request $request)
    {
        // Exemplo: cabeçalho de cache simples (1 minuto) para demonstrar em aula
        try {
            $livros = Livro::orderByDesc('id')->get();

            return response()
                ->json([
                    'ok' => true,
                    'data' => $livros,
                    'user' => [
                        'id' => Auth::id(),
                        'name' => optional(Auth::user())->name,
                        'is_logged' => Auth::check(),
                    ],
                ], 200)
                ->header('Cache-Control', 'max-age=60');
        } catch (Throwable $e) {
            return response()->json([
                'ok' => false,
                'error' => 'Erro ao listar livros.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    // GET /api/livros/{id}
    public function show($id)
    {
        try {
            $livro = Livro::find($id);

            if (!$livro) {
                return response()->json([
                    'ok' => false,
                    'error' => 'Livro não encontrado.'
                ], 404);
            }

            return response()->json([
                'ok' => true,
                'data' => $livro
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'ok' => false,
                'error' => 'Erro ao buscar livro.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    // POST /api/livros
    public function store(Request $request)
    {
        // Validação simples inline (poderia ser FormRequest depois)
        $validator = Validator::make($request->all(), [
            'nome' => ['required', 'string', 'max:255'],
            'autor' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $livro = Livro::create([
                'nome' => $request->input('nome'),
                'autor' => $request->input('autor'),
            ]);

            return response()->json([
                'ok' => true,
                'data' => $livro,
                'message' => 'Livro criado com sucesso.'
            ], 201);
        } catch (Throwable $e) {
            return response()->json([
                'ok' => false,
                'error' => 'Erro ao criar livro.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    // DELETE /api/livros/{id}
    public function destroy($id)
    {
        try {
            $livro = Livro::find($id);

            if (!$livro) {
                return response()->json([
                    'ok' => false,
                    'error' => 'Livro não encontrado.'
                ], 404);
            }

            $livro->delete();

            return response()->json([
                'ok' => true,
                'message' => 'Livro excluído com sucesso.'
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'ok' => false,
                'error' => 'Erro ao excluir livro.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
