{{-- resources/views/locacoes/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Nova Locação')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Cadastro de Locação</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('locacoes.store') }}" method="POST" novalidate>
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label for="cliente_id" class="form-label">Cliente</label>
                <select name="cliente_id" id="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror" required>
                    <option value="" disabled selected>Selecione o cliente</option>
                    @foreach($clientes as $id => $nome)
                        <option value="{{ $id }}" {{ old('cliente_id') == $id ? 'selected' : '' }}>{{ $nome }}</option>
                    @endforeach
                </select>
                @error('cliente_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label for="veiculo_id" class="form-label">Veículo</label>
                <select name="veiculo_id" id="veiculo_id" class="form-select @error('veiculo_id') is-invalid @enderror" required>
                    <option value="" disabled selected>Selecione o veículo</option>
                    @foreach($veiculos as $id => $modelo)
                        <option value="{{ $id }}" {{ old('veiculo_id') == $id ? 'selected' : '' }}>{{ $modelo }}</option>
                    @endforeach
                </select>
                @error('veiculo_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label for="user_id" class="form-label">Usuário</label>
                <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                    <option value="" disabled selected>Selecione o usuário</option>
                    @foreach($users as $id => $name)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="data_inicio" class="form-label">Data de Início</label>
                <input type="date" name="data_inicio" id="data_inicio" class="form-control @error('data_inicio') is-invalid @enderror" value="{{ old('data_inicio') }}" required>
                @error('data_inicio')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="data_fim" class="form-label">Data de Fim</label>
                <input type="date" name="data_fim" id="data_fim" class="form-control @error('data_fim') is-invalid @enderror" value="{{ old('data_fim') }}" required>
                @error('data_fim')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Cadastrar Locação</button>
            <a href="{{ route('locacoes') }}" class="btn btn-link">Cancelar</a>
        </div>
    </form>
</div>
@endsection
