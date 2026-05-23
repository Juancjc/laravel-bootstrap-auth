<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
class LivroController extends Controller
{
    public function index()
    {
        //em php nativo
//        session_start();
//
//// Criar cookie com data e hora atual, expira em 1 hora
//        setcookie("ultimo_acesso", date("d/m/Y H:i:s"), time() + 3600, "/");
//// Criar variável de sessão
//        $_SESSION['usuario'] = "Berry";
//        $_SESSION['ultimo_login'] = date("d/m/Y H:i:s");
        $agora = now()->format('d/m/Y H:i:s');

        // Salva na sessão
        session(['ultimo_login' => $agora]);

        // Busca livros no banco
        $livros = Livro::with('usuarioEmprestado')->get();
        $usuarios = User::where('id', '!=', auth()->id())->get();
        return response()
            ->view('livro.index', compact('livros', 'usuarios'))
            ->cookie('ultimo_acesso', $agora, 60);
    }
    public function create()
    {
        return view('livro.create');
    }
    public function store(Request $request)
    {
        session(['ultimo_login' => now()->format('d/m/Y H:i:s')]);
        $request->validate([
            'nome' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
        ]);
        //salvar no banco de dados
        Livro::create([
            'nome' => $request->nome,
            'autor' => $request->autor,
        ]);
        return redirect()->route('livro.index')->with('success', 'Livro criado com sucesso!');
    }
    public function edit($id)
    {
        $livro = Livro::find($id);
        return view('livro.create', compact('livro'));
    }
    public function update(Request $request, $id)
    {
        session(['ultimo_login' => now()->format('d/m/Y H:i:s')]);
        //atualizar no banco de dados
        $livro = Livro::find($id);
        $livro->nome = request()->nome;
        $livro->autor = request()->autor;
        $livro->save();
        return redirect()->route('livro.index')->with('success', 'Livro atualizado com sucesso!');
    }
    public function destroy($id)
    {
        session(['ultimo_login' => now()->format('d/m/Y H:i:s')]);
        //deletar no banco de dados
        $livro = Livro::find($id);
        $livro->delete();
        return redirect()->route('livro.index')->with('success', 'Livro deletado com sucesso!');
    }
    public function emprestar($id, $id_usuario_emprestado)
    {
        $livro = Livro::find($id);
        $livro->id_usuario_emprestado = $id_usuario_emprestado;
        $livro->save();
        return redirect()->route('livro.index')->with('success', 'Livro emprestado com sucesso!');
    }
}
