@extends('layouts.app')

@section('content')
    <div class="p-4 bg-light border rounded">
        <h2 class="h4 mb-2">Lista de livros</h2>
        <a href="{{ route('livro.create') }}" class="btn btn-primary mb-3">Adicionar Novo Livro</a>
        @foreach($livros as $livro)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $livro->nome }}</h5>
                    <p class="card-text">Autor: {{ $livro->autor }}</p>
                    <a href="{{ route('livro.edit', $livro->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('livro.destroy', $livro->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir</button>
                    </form>
                </div>
            </div>

        @endforeach
        @if(request()->cookie('ultimo_acesso'))
            <p class="text-muted">
                ultima vez usado o banco de dados{{ request()->cookie('ultimo_acesso') }}
            </p>
        @endif
        @if(session('ultimo_login'))
            <p class="text-muted">
                Último login: {{ session('ultimo_login') }}
            </p>
        @endif
    </div>
@endsection
