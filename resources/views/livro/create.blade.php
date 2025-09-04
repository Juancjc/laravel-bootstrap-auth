@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header {{ isset($livro) ? 'bg-warning text-dark' : 'bg-primary text-white' }}">
                        <h4>{{ isset($livro) ? 'Editar Livro' : 'Cadastrar Livro' }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ isset($livro) ? route('livro.update', $livro->id) : route('livro.store') }}" method="POST">
                            @csrf
                            @if(isset($livro))
                                @method('PUT')
                            @endif
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome do Livro</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $livro->nome ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="autor" class="form-label">Autor</label>
                                <input type="text" class="form-control" id="autor" name="autor" value="{{ old('autor', $livro->autor ?? '') }}" required>
                            </div>
                            <button type="submit" class="btn {{ isset($livro) ? 'btn-primary' : 'btn-success' }}">
                                {{ isset($livro) ? 'Atualizar' : 'Salvar' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
