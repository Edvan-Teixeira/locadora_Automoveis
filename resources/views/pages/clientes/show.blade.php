{{-- resources/views/clientes/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detalhes do Cliente')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Detalhes do Cliente</h2>
        <div>
            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-outline-secondary me-2">Editar</a>
            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Excluir</button>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <h4>{{ $cliente->nome }}</h4>
                <ul class="list-unstyled mt-3">
                    <li><strong>Email:</strong> {{ $cliente->email }}</li>
                    <li><strong>CPF:</strong> {{ $cliente->cpf }}</li>
                    <li><strong>RG:</strong> {{ $cliente->rg }}</li>
                    <li><strong>Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($cliente->data_nascimento)->format('d/m/Y') }}</li>
                    <li><strong>Gênero:</strong> {{ $cliente->genero == 'M' ? 'Masculino' : 'Feminino' }}</li>
                    <li><strong>CNH:</strong> {{ $cliente->cnh }}</li>
                    @if($cliente->logradouro)
                        <li><strong>Logradouro:</strong> {{ $cliente->logradouro }}</li>
                        <li><strong>Número:</strong> {{ $cliente->numero ?? '-' }}</li>
                        <li><strong>Bairro:</strong> {{ $cliente->bairro ?? '-' }}</li>
                        <li><strong>Cidade:</strong> {{ $cliente->cidade }}</li>
                        <li><strong>Estado:</strong> {{ $cliente->estado }}</li>
                        <li><strong>CEP:</strong> {{ $cliente->cep }}</li>
                    @endif
                    <li><strong>Telefone:</strong> {{ $cliente->telefone }}</li>
                    @if($cliente->celular)
                        <li><strong>Celular:</strong> {{ $cliente->celular }}</li>
                    @endif
                </ul>
                <a href="{{ route('clientes') }}" class="btn btn-link mt-3">&larr; Voltar para a lista</a>
            </div>
        </div>
        <div class="col-md-6">
            <h5 class="mb-3">Locações do Cliente</h5>
            @if($cliente->locacoes->count())
                <div class="table-responsive">
                    <table class="table table-borderless align-middle">
                        <thead>
                            <tr class="text-muted small">
                                <th>Veículo</th>
                                <th>Início</th>
                                <th>Fim</th>
                                <th>Custo Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cliente->locacoes as $locacao)
                                <tr>
                                    <td class="small">{{ $locacao->vehicle->modelo ?? '-' }}</td>
                                    <td class="small">{{ \Carbon\Carbon::parse($locacao->data_inicio)->format('d/m/Y') }}</td>
                                    <td class="small">{{ \Carbon\Carbon::parse($locacao->data_fim)->format('d/m/Y') }}</td>
                                    <td class="small">R$ {{ number_format($locacao->valor_total,2,',','.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">Nenhuma locação registrada para este cliente.</p>
            @endif
        </div>
    </div>
</div>
@endsection
