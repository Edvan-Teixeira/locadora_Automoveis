@extends('layouts.app')

@section('title','Entrar')

@section('content')
<main class="form-signin d-flex align-items-center justify-content-center" style="min-height: 80vh;">
  <form action="{{ route('login') }}" method="POST" novalidate class="text-center w-100" style="max-width: 360px;">
    @csrf

    {{-- Logo --}}
    <img class="mb-4" src="{{ asset('images/car2.png') }}" alt="Logo" width="140" height="57">

    <h1 class="h3 mb-3 fw-normal">Acessar</h1>

    {{-- Email --}}
    <div class="form-floating mb-2">
      <input
        type="email"
        name="email"
        id="floatingInput"
        placeholder="name@example.com"
        value="{{ old('email') }}"
        class="form-control @error('email') is-invalid @enderror"
      >
      <label for="floatingInput">Email</label>
      @error('email')
        <div class="invalid-feedback text-start">
          {{ $message }}
        </div>
      @enderror
    </div>

    {{-- Senha --}}
    <div class="form-floating mb-2">
      <input
        type="password"
        name="password"
        id="floatingPassword"
        placeholder="Senha"
        class="form-control @error('password') is-invalid @enderror"
      >
      <label for="floatingPassword">Senha</label>
      @error('password')
        <div class="invalid-feedback text-start">
          {{ $message }}
        </div>
      @enderror
    </div>

    {{-- Lembre-me --}}
    <div class="checkbox mb-3 text-start">
      <label>
        <input
          type="checkbox"
          name="remember"
          value="1"
          {{ old('remember') ? 'checked' : '' }}
        > manter logado
      </label>
    </div>

    {{-- Erro genérico de credenciais --}}
    @if ($errors->has('email') && !$errors->has('password'))
      <div class="alert alert-danger text-start">
        {{ $errors->first('email') }}
      </div>
    @endif

    {{-- Botão --}}
    <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>

    <p class="mt-3">
      Não tem conta? <a href="{{ route('register') }}">Cadastrar</a>
    </p>

    <p class="mt-5 mb-3 text-muted">&copy;{{ date('Y') }}</p>
  </form>
</main>
@endsection
