@extends('layouts.app')

@section('css')

@endsection

@section('content')
    <div class="p-4 bg-light border rounded">
        <h2 class="h4 mb-2">Lista de livros</h2>

        <a href="{{ route('livro.create') }}" class="btn btn-primary mb-3">
            Adicionar Novo Livro
        </a>

        @forelse($livros as $livro)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $livro->nome }}</h5>

                    <p class="card-text mb-2">
                        Autor: {{ $livro->autor }}
                    </p>
                    @if($livro->usuarioEmprestado)
                        <p class="card-text mb-2">
                            Emprestado: {{ $livro->usuarioEmprestado ? $livro->usuarioEmprestado->name : 'Nenhum' }}
                        </p>
                    @endif


                    @if(!empty($livro->id_usuario_emprestado))
                        <p class="text-danger mb-3">
                            <strong>Status:</strong> Emprestado
                        </p>
                    @else
                        <p class="text-success mb-3">
                            <strong>Status:</strong> Disponível
                        </p>
                    @endif

                    <a href="{{ route('livro.edit', $livro->id) }}" class="btn btn-sm btn-warning">
                        Editar
                    </a>

                    <form id="form-excluir-{{ $livro->id }}"
                          action="{{ route('livro.destroy', $livro->id) }}"
                          method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button type="button"
                                class="btn btn-sm btn-danger btn-excluir"
                                data-id="{{ $livro->id }}">
                            Excluir
                        </button>
                    </form>

                    <button type="button"
                            class="btn btn-sm btn-primary btn-abrir-modal-emprestar"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEmprestarLivro"
                            data-id="{{ $livro->id }}"
                            data-nome="{{ $livro->nome }}"
                            data-autor="{{ $livro->autor }}">
                        Emprestar
                    </button>
                </div>
            </div>
        @empty
            <div class="alert alert-info">
                Nenhum livro cadastrado.
            </div>
        @endforelse

        @if(request()->cookie('ultimo_acesso'))
            <p class="text-muted">
                Última vez usado o banco de dados: {{ request()->cookie('ultimo_acesso') }}
            </p>
        @endif

        @if(session('ultimo_login'))
            <p class="text-muted">
                Último login: {{ session('ultimo_login') }}
            </p>
        @endif
    </div>

    {{-- Modal Emprestar Livro --}}
    <div class="modal fade"
         id="modalEmprestarLivro"
         tabindex="-1"
         aria-labelledby="modalEmprestarLivroLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEmprestarLivro" method="POST">
                    @csrf

                    <input type="hidden" id="livro_id" name="livro_id">

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEmprestarLivroLabel">
                            Emprestar Livro
                        </h1>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Fechar">
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="alert alert-info">
                            <strong>Livro:</strong> <span id="modalLivroNome"></span><br>
                            <strong>Autor:</strong> <span id="modalLivroAutor"></span>
                        </div>

                        <div class="mb-3">
                            <label for="id_usuario_emprestado" class="form-label">
                                Usuário para empréstimo
                            </label>

                            <select class="form-select"
                                    id="id_usuario_emprestado"
                                    name="id_usuario_emprestado"
                                    required>
                                <option value="" disabled selected>
                                    Selecione um usuário
                                </option>

                                @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">
                                        {{ $usuario->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit"
                                class="btn btn-primary"
                                id="btnConfirmarEmprestimo">
                            Confirmar Empréstimo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
        <script>
            Swal.fire({
                title: 'Sucesso!',
                text: @json(session('success')),
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                title: 'Erro!',
                text: @json(session('error')),
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <script>
        document.querySelectorAll('.btn-excluir').forEach(function (botao) {
            botao.addEventListener('click', function () {
                const livroId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Tem certeza?',
                    text: 'Esta ação não pode ser desfeita!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-excluir-' + livroId).submit();
                    }
                });
            });
        });

        $('.btn-abrir-modal-emprestar').on('click', function () {
            const livroId = $(this).data('id');
            const livroNome = $(this).data('nome');
            const livroAutor = $(this).data('autor');

            $('#livro_id').val(livroId);
            $('#modalLivroNome').text(livroNome);
            $('#modalLivroAutor').text(livroAutor);
            $('#id_usuario_emprestado').val('');
        });

        $('#formEmprestarLivro').on('submit', function (event) {
            event.preventDefault();

            const livroId = $('#livro_id').val();
            const usuarioId = $('#id_usuario_emprestado').val();

            if (!usuarioId) {
                Swal.fire({
                    title: 'Atenção!',
                    text: 'Selecione um usuário para emprestar o livro.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });

                return;
            }

            let url = "{{ route('livro.emprestar', ['id' => ':id', 'id_usuario_emprestado' => ':usuario']) }}";

            url = url.replace(':id', livroId);
            url = url.replace(':usuario', usuarioId);

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                beforeSend: function () {
                    $('#btnConfirmarEmprestimo')
                        .prop('disabled', true)
                        .text('Salvando...');
                },
                success: function (response) {
                    const modalElement = document.getElementById('modalEmprestarLivro');
                    const modalInstance = bootstrap.Modal.getInstance(modalElement);

                    if (modalInstance) {
                        modalInstance.hide();
                    }

                    Swal.fire({
                        title: 'Sucesso!',
                        text: response.message ?? 'Livro emprestado com sucesso!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function (xhr) {
                    let mensagem = 'Não foi possível emprestar o livro.';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        mensagem = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        title: 'Erro!',
                        text: mensagem,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                },
                complete: function () {
                    $('#btnConfirmarEmprestimo')
                        .prop('disabled', false)
                        .text('Confirmar Empréstimo');
                }
            });
        });
    </script>
@endsection
