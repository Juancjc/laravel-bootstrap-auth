@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow-sm">
      <div class="card-body">
        <h1 class="h4 mb-3">Criar conta</h1>
        <form method="POST" action="{{ route('register') }}">
          @csrf

          <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">Senha</label>
            <input type="password" name="password" required class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">Confirmar Senha</label>
            <input type="password" name="password_confirmation" required class="form-control">
          </div>

          <button class="btn btn-success w-100">Cadastrar</button>
        </form>

        <hr class="my-4">
        <p class="mb-0 text-center">
          Já tem conta?
          <a href="{{ route('login') }}">Entrar</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
