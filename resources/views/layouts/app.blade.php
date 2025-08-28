<!doctype html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name', 'Laravel') }}</title>

  @vite(['resources/scss/app.scss','resources/js/app.js'])
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ url('/') }}">{{ config('app.name','Laravel') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="nav" class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        @auth
          <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a></li>
        @endauth
      </ul>
      <ul class="navbar-nav">
        @guest
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Entrar</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Cadastrar</a></li>
        @else
          <li class="nav-item">
            <span class="nav-link">Olá, <strong>{{ Auth::user()->name }}</strong></span>
          </li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="btn btn-outline-danger btn-sm">Sair</button>
            </form>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

<main class="container py-4">
  @include('partials.flash')
  @yield('content')
</main>

<footer class="py-4 text-center text-muted border-top">
  <small>Laravel + Breeze + Bootstrap</small>
</footer>
</body>
</html>
