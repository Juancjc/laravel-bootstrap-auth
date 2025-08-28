@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3>Bem-vindo ao Laravel</h3>
                    </div>
                    <div class="card-body">
                        <p>
                            Laravel é um framework PHP moderno e elegante para desenvolvimento web. Ele oferece uma sintaxe expressiva, ferramentas poderosas e integração fácil com diversos recursos, como autenticação, rotas, cache e muito mais.
                        </p>
                        <ul>
                            <li>Rápido para começar</li>
                            <li>Segurança integrada</li>
                            <li>Comunidade ativa</li>
                            <li>Documentação completa</li>
                        </ul>
                        <a href="https://laravel.com" class="btn btn-primary" target="_blank">Saiba mais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
