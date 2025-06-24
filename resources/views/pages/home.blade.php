@extends('layouts.app')

@section('content')
@php
    $nomes = ['João', 'Maria', 'Pedro'];
@endphp
    <div class="container p-4">
        <div class="row">
    @foreach ($nomes as $nome)
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $nome }}</h5>
                    <p class="card-text">Preço: R$ {{ $nome }}</p>
                    <a href="#" class="btn btn-primary">Ver Detalhes</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

    </div>
@endsection
