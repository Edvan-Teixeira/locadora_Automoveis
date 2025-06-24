{{-- resources/views/locacoes/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Lista de Locações')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Locações</h2>
        <a href="{{ route('locacoes.create') }}" class="btn btn-outline-primary">+ Nova Locação</a>
    </div>

    @if(session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    @if($locacoes->count())
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Cliente</th>
                        <th>Veículo</th>
                        <th>Usuário</th>
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Custo Total</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locacoes as $locacao)
                        <tr>
                            <td>{{ $locacao->cliente->nome }}</td>
                            <td>{{ $locacao->veiculo->modelo }}</td>
                            <td>{{ $locacao->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($locacao->data_inicio)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($locacao->data_fim)->format('d/m/Y') }}</td>
                            <td>R$ {{ number_format($locacao->valor_total, 2, ',', '.') }}</td>
                            <td class="text-end">
                                <a href="{{ route('locacoes.show', $locacao) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                                <a href="{{ route('locacoes.edit', $locacao) }}" class="btn btn-sm btn-outline-primary ms-1">Editar</a>
                                <form action="{{ route('locacoes.destroy', $locacao) }}" method="POST" class="d-inline ms-1" onsubmit="return confirm('Confirma exclusão?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {!! $locacoes->links() !!}
        </div>
    @else
        <p class="text-muted">Nenhuma locação registrada ainda.</p>
    @endif
</div>
@endsection
