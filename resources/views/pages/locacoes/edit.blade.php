@extends('layouts.app')

@section('title', 'Editar Locação')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Editar Locação</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('locacoes.update', $locacao) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Cliente --}}
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-select" required>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id', $locacao->cliente_id) == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Veículo --}}
        <div class="mb-3">
            <label for="veiculo_id" class="form-label">Veículo</label>
            <select name="veiculo_id" id="veiculo_id" class="form-select" required>
                @foreach ($veiculos as $veiculo)
                    <option value="{{ $veiculo->id }}" {{ old('veiculo_id', $locacao->veiculo_id) == $veiculo->id ? 'selected' : '' }}>
                        {{ $veiculo->marca }} {{ $veiculo->modelo }} - {{ $veiculo->placa }}
                    </option>
                @endforeach
            </select>
        </div>

       {{-- Data de Início --}}
        <div class="mb-3">
            <label for="data_inicio" class="form-label">Data de Início</label>
            <input type="date" name="data_inicio" id="data_inicio" class="form-control"
                value="{{ old('data_inicio', $locacao->data_inicio->format('Y-m-d')) }}" required>
        </div>

        {{-- Data de Término --}}
        <div class="mb-3">
            <label for="data_fim" class="form-label">Data de Término</label>
            <input type="date" name="data_fim" id="data_fim" class="form-control"
                value="{{ old('data_fim', $locacao->data_fim->format('Y-m-d')) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="{{ route('locacoes') }}" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>
@endsection
