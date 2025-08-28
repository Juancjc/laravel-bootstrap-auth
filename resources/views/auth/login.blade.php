@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow-sm">
      <div class="card-body">
        <h1 class="h4 mb-3">Entrar</h1>
        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">Senha</label>
            <input type="password" name="password" required class="form-control">
          </div>

          <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
              <label class="form-check-label" for="remember_me">Lembrar-me</label>
            </div>
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}">Esqueci minha senha</a>
            @endif
          </div>

          <button class="btn btn-primary w-100">Entrar</button>
        </form>

        <hr class="my-4">
        <p class="mb-0 text-center">
          Não tem conta?
          <a href="{{ route('register') }}">Cadastre-se</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
