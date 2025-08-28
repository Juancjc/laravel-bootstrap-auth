@extends('layouts.app')

@section('content')
  <div class="p-4 bg-light border rounded">
    <h2 class="h4 mb-2">Olá, {{ Auth::user()->name }}</h2>
    <p class="mb-0">Você está logado.</p>
  </div>
@endsection
