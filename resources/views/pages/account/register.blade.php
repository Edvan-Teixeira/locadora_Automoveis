@extends('layouts.app')

@section('title','Cadastro')

@section('content')
<main class="form-signin d-flex align-items-center justify-content-center" style="min-height: 80vh;">
  <form action="{{ route('register') }}" method="POST" novalidate class="text-center w-100" style="max-width: 360px;">
    @csrf

    {{-- Logo ou ícone --}}
    <img class="mb-4" src="{{ asset('images/car2.png') }}" alt="Logo" width="140" height="57">

    <h1 class="h3 mb-3 fw-normal">Criar Conta</h1>

    {{-- Nome --}}
    <div class="form-floating mb-2 text-start">
      <input
        type="text"
        name="name"
        id="floatingName"
        placeholder="Nome"
        value="{{ old('name') }}"
        class="form-control @error('name') is-invalid @enderror"
      >
      <label for="floatingName">Nome</label>
      @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    {{-- Email --}}
    <div class="form-floating mb-2 text-start">
      <input
        type="email"
        name="email"
        id="floatingEmail"
        placeholder="name@example.com"
        value="{{ old('email') }}"
        class="form-control @error('email') is-invalid @enderror"
      >
      <label for="floatingEmail">Email</label>
      @error('email')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    {{-- Senha --}}
    <div class="form-floating mb-2 text-start">
      <input
        type="password"
        name="password"
        id="floatingPassword"
        placeholder="Senha"
        class="form-control @error('password') is-invalid @enderror"
      >
      <label for="floatingPassword">Senha</label>
      @error('password')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    {{-- Confirmação de Senha --}}
    <div class="form-floating mb-3 text-start">
      <input
        type="password"
        name="password_confirmation"
        id="floatingPasswordConfirm"
        placeholder="Confirmar Senha"
        class="form-control"
      >
      <label for="floatingPasswordConfirm">Confirmar Senha</label>
    </div>

    {{-- Botão --}}
    <button class="w-100 btn btn-lg btn-primary" type="submit">Cadastrar</button>

    <p class="mt-3">
      Já tem conta? <a href="{{ route('login') }}">Entrar</a>
    </p>
    <a href="{{ route('landing') }}">Voltar</a>

    <p class="mt-5 mb-3 text-muted">&copy;{{ date('Y') }}</p>
  </form>
</main>
@endsection
