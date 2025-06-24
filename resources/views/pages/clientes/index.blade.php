{{-- resources/views/clientes/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Lista de Clientes')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Clientes Cadastrados</h2>
        <a href="{{ route('clientes.cadastro') }}" class="btn btn-outline-primary">+ Novo Cliente</a>
    </div>

    @if(session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    @if($clientes->count())
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($clientes as $cliente)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $cliente->nome }}</h5>
                            <p class="card-text mb-1"><strong>CPF:</strong> {{ $cliente->cpf }}</p>
                            <p class="card-text mb-1"><strong>Telefone:</strong> {{ $cliente->telefone }}</p>
                            @if($cliente->celular)
                                <p class="card-text mb-1"><strong>Celular:</strong> {{ $cliente->celular }}</p>
                            @endif
                            <a href="{{ route('clientes.show', $cliente) }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {!! $clientes->links() !!}
        </div>
    @else
        <p class="text-muted">Nenhum cliente cadastrado ainda.</p>
    @endif
</div>
@endsection
