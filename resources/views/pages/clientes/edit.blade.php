{{-- resources/views/clientes/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Editar Cliente</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.update', $cliente) }}" method="POST" novalidate>
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $cliente->nome) }}" required>
                @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $cliente->email) }}" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" name="cpf" id="cpf" class="form-control @error('cpf') is-invalid @enderror" value="{{ old('cpf', $cliente->cpf) }}" required>
                @error('cpf')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label for="rg" class="form-label">RG</label>
                <input type="text" name="rg" id="rg" class="form-control @error('rg') is-invalid @enderror" value="{{ old('rg', $cliente->rg) }}" required>
                @error('rg')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" name="data_nascimento" id="data_nascimento" class="form-control @error('data_nascimento') is-invalid @enderror" value="{{ old('data_nascimento', $cliente->data_nascimento->format('Y-m-d')) }}" required>
                @error('data_nascimento')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label for="genero" class="form-label">Gênero</label>
                <select name="genero" id="genero" class="form-select @error('genero') is-invalid @enderror">
                    <option value="" disabled>Selecione</option>
                    <option value="M" {{ old('genero', $cliente->genero)=='M' ? 'selected':'' }}>Masculino</option>
                    <option value="F" {{ old('genero', $cliente->genero)=='F' ? 'selected':'' }}>Feminino</option>
                </select>
                @error('genero')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label for="cnh" class="form-label">CNH</label>
                <input type="text" name="cnh" id="cnh" class="form-control @error('cnh') is-invalid @enderror" value="{{ old('cnh', $cliente->cnh) }}" required>
                @error('cnh')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            {{-- Campos de Endereço --}}
            <div class="col-md-8">
                <label for="logradouro" class="form-label">Logradouro</label>
                <input type="text" name="logradouro" id="logradouro" class="form-control @error('logradouro') is-invalid @enderror" value="{{ old('logradouro', $cliente->logradouro) }}" required>
                @error('logradouro')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label for="numero" class="form-label">Número</label>
                <input type="text" name="numero" id="numero" class="form-control @error('numero') is-invalid @enderror" value="{{ old('numero', $cliente->numero) }}">
                @error('numero')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label for="bairro" class="form-label">Bairro</label>
                <input type="text" name="bairro" id="bairro" class="form-control @error('bairro') is-invalid @enderror" value="{{ old('bairro', $cliente->bairro) }}">
                @error('bairro')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label for="cidade" class="form-label">Cidade</label>
                <input type="text" name="cidade" id="cidade" class="form-control @error('cidade') is-invalid @enderror" value="{{ old('cidade', $cliente->cidade) }}" required>
                @error('cidade')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" maxlength="2" value="{{ old('estado', $cliente->estado) }}" required>
                @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" name="cep" id="cep" class="form-control @error('cep') is-invalid @enderror" value="{{ old('cep', $cliente->cep) }}" required>
                @error('cep')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control @error('telefone') is-invalid @enderror" value="{{ old('telefone', $cliente->telefone) }}" required>
                @error('telefone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label for="celular" class="form-label">Celular</label>
                <input type="text" name="celular" id="celular" class="form-control @error('celular') is-invalid @enderror" value="{{ old('celular', $cliente->celular) }}">
                @error('celular')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('clientes.show', $cliente) }}" class="btn btn-link">Cancelar</a>
        </div>
    </form>
</div>
@endsection
