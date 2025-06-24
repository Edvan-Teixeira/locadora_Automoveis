@extends('layouts.app')

@section('title','Login')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <h2 class="mb-4">Entrar</h2>
    <form action="{{ route('login') }}" method="POST" novalidate>
      @csrf

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

      {{-- Lembre-me --}}
      <div class="form-check mb-4">
        <input
          class="form-check-input"
          type="checkbox"
          name="remember"
          id="remember"
          {{ old('remember') ? 'checked' : '' }}
        >
        <label class="form-check-label" for="remember">
          Lembre-me
        </label>
      </div>

      {{-- Erro genérico de credenciais --}}
      @if ($errors->has('email') && ! old('password'))
        <div class="alert alert-danger">
          {{ $errors->first('email') }}
        </div>
      @endif

      <button type="submit" class="btn btn-primary w-100">Entrar</button>
      <p class="mt-3 text-center">
        Não tem conta? <a href="{{ route('register') }}">Cadastrar</a>
      </p>
    </form>
  </div>
</div>
@endsection
