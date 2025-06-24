@extends('layouts.app')

@section('title', 'Lista de Veículos')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Veículos Cadastrados</h2>
        <a href="{{ route('veiculos.cadastro') }}" class="btn btn-outline-primary">+ Novo Veículo</a>
    </div>

    @if(session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    @if($veiculos->count())
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($veiculos as $veiculo)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        @if($veiculo->imagem)
                            <img src="{{ asset('storage/' . $veiculo->imagem) }}" class="card-img-top" alt="Imagem do veículo">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $veiculo->marca }} {{ $veiculo->modelo }}</h5>
                            <p class="card-text mb-1"><strong>Ano:</strong> {{ $veiculo->ano }}</p>
                            <p class="card-text mb-1"><strong>Placa:</strong> {{ $veiculo->placa }}</p>
                            <p class="card-text mb-1"><strong>Cor:</strong> {{ ucfirst($veiculo->cor) }}</p>
                            <p class="card-text"><strong>Diária:</strong> R$ {{ number_format($veiculo->valor_diaria, 2, ',', '.') }}</p>
                            <a href="{{ route('veiculos.show', $veiculo) }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {!! $veiculos->links() !!}
        </div>
    @else
        <p class="text-muted">Nenhum veículo cadastrado ainda.</p>
    @endif
</div>
@endsection
