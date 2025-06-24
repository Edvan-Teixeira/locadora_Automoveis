@extends('layouts.app')

@section('title','Cadastro')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <h2 class="mb-4">Criar Conta</h2>
    <form action="{{ route('register') }}" method="POST" novalidate>
      @csrf

      {{-- Nome --}}
      <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input
          type="text"
          name="name"
          id="name"
          value="{{ old('name') }}"
          class="form-control @error('name') is-invalid @enderror"
        >
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      {{-- Email --}}
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input
          type="email"
          name="email"
          id="email"
          value="{{ old('email') }}"
          class="form-control @error('email') is-invalid @enderror"
        >
        @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      {{-- Senha --}}
      <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input
          type="password"
          name="password"
          id="password"
          class="form-control @error('password') is-invalid @enderror"
        >
        @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      {{-- Confirmação de Senha --}}
      <div class="mb-4">
        <label for="password_confirmation" class="form-label">Confirmar Senha</label>
        <input
          type="password"
          name="password_confirmation"
          id="password_confirmation"
          class="form-control"
        >
      </div>

      <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
      <p class="mt-3 text-center">
        Já tem conta? <a href="{{ route('login') }}">Entrar</a>
      </p>
    </form>
  </div>
</div>
@endsection
