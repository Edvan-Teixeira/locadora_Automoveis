{{-- resources/views/veiculos/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Editar Veículo')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Editar Veículo</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('veiculos.update', $veiculo) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" name="marca" id="marca" class="form-control @error('marca') is-invalid @enderror" value="{{ old('marca', $veiculo->marca) }}" required>
                @error('marca')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" name="modelo" id="modelo" class="form-control @error('modelo') is-invalid @enderror" value="{{ old('modelo', $veiculo->modelo) }}" required>
                @error('modelo')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="ano" class="form-label">Ano</label>
                <select name="ano" id="ano" class="form-select @error('ano') is-invalid @enderror" required>
                    @for ($i = date('Y'); $i >= 1976; $i--)
                        <option value="{{ $i }}" {{ old('ano', $veiculo->ano) == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                @error('ano')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="cor" class="form-label">Cor</label>
                <input type="text" name="cor" id="cor" class="form-control @error('cor') is-invalid @enderror" value="{{ old('cor', $veiculo->cor) }}" required>
                @error('cor')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="placa" class="form-label">Placa</label>
                <input type="text" name="placa" id="placa" class="form-control @error('placa') is-invalid @enderror" value="{{ old('placa', $veiculo->placa) }}" required>
                @error('placa')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="valor_diaria" class="form-label">Valor da Diária (R$)</label>
                <input type="number" step="0.01" min="0" name="valor_diaria" id="valor_diaria" class="form-control @error('valor_diaria') is-invalid @enderror" value="{{ old('valor_diaria', $veiculo->valor_diaria) }}" required>
                @error('valor_diaria')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="imagem" class="form-label">Imagem do Veículo</label>
                @if($veiculo->imagem)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $veiculo->imagem) }}" alt="Imagem atual" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                @endif
                <input type="file" name="imagem" id="imagem" class="form-control @error('imagem') is-invalid @enderror">
                @error('imagem')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <div class="form-text">Envie uma nova imagem para substituir a atual.</div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('veiculos.show', $veiculo) }}" class="btn btn-link">Cancelar</a>
    </form>
</div>
@endsection
