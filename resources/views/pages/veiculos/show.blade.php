{{-- resources/views/veiculos/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detalhes do Veículo')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Detalhes do Veículo</h2>
        <div>
            <a href="{{ route('veiculos.edit', $veiculo) }}" class="btn btn-outline-secondary me-2">Editar</a>
            <form action="{{ route('veiculos.destroy', $veiculo) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este veículo?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Excluir</button>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                @if($veiculo->imagem)
                    <img src="{{ asset('storage/' . $veiculo->imagem) }}" class="card-img-top" alt="Imagem do veículo">
                @else
                    <img src="{{ asset('images/default-car.jpg') }}" class="card-img-top" alt="Imagem padrão">
                @endif
            </div>
        </div>
        <div class="col-md-7">
            <div class="card border-0 shadow-sm p-4">
                <h4>{{ $veiculo->marca }} {{ $veiculo->modelo }}</h4>
                <ul class="list-unstyled mt-3">
                    <li><strong>Ano:</strong> {{ $veiculo->ano }}</li>
                    <li><strong>Placa:</strong> {{ $veiculo->placa }}</li>
                    <li><strong>Cor:</strong> {{ ucfirst($veiculo->cor) }}</li>
                    <li><strong>Valor da Diária:</strong> R$ {{ number_format($veiculo->valor_diaria, 2, ',', '.') }}</li>
                </ul>
                <a href="{{ route('veiculos') }}" class="btn btn-link mt-3">&larr; Voltar para a lista</a>
            </div>
        </div>
    </div>
</div>
@endsection
