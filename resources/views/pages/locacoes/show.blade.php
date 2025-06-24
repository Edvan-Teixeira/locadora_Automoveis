{{-- resources/views/locacoes/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detalhes da Locação')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Detalhes da Locação</h2>
        <div>
            <a href="{{ route('locacoes.edit', $locacao) }}" class="btn btn-outline-secondary me-2">Editar</a>
            <form action="{{ route('locacoes.destroy', $locacao) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirma exclusão desta locação?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Excluir</button>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <h4>Locação #{{ $locacao->id }}</h4>
                <ul class="list-unstyled mt-3">
                    <li><strong>Cliente:</strong> {{ $locacao->cliente->nome }}</li>
                    <li><strong>Veículo:</strong> {{ $locacao->veiculo->modelo }} ({{ $locacao->veiculo->placa }})</li>
                    <li><strong>Usuário:</strong> {{ $locacao->user->name }}</li>
                    <li><strong>Data Início:</strong> {{ \Carbon\Carbon::parse($locacao->data_inicio)->format('d/m/Y') }}</li>
                    <li><strong>Data Fim:</strong> {{ \Carbon\Carbon::parse($locacao->data_fim)->format('d/m/Y') }}</li>
                    <li><strong>Dias:</strong> {{ \Carbon\Carbon::parse($locacao->data_inicio)->diffInDays(\Carbon\Carbon::parse($locacao->data_fim)) + 1 }}</li>
                    <li><strong>Custo Diário:</strong> R$ {{ number_format($locacao->veiculo->valor_diaria,2,',','.') }}</li>
                    <li><strong>Custo Total:</strong> R$ {{ number_format($locacao->valor_total,2,',','.') }}</li>
                </ul>
                <a href="{{ route('locacoes') }}" class="btn btn-link mt-3">&larr; Voltar para lista</a>
            </div>
        </div>
        <div class="col-md-6">
            <h5 class="mb-3">Informações Financeiras</h5>
            <div class="card border-0 shadow-sm p-4">
                <p>Este valor de <strong>R$ {{ number_format($locacao->valor_total,2,',','.') }}</strong> deve ser pago na entrega do veículo.</p>
                <p class="text-muted small">Controle financeiro atualizado automaticamente com base nas locações.</p>
            </div>
        </div>
    </div>
</div>
@endsection
