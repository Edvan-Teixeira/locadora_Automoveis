@extends('layouts.app')

@section('content')
@php
    $nomes = ['João', 'Maria', 'Pedro'];
@endphp
    <div class="container p-4">
        <table class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Veículo</th>
                <th>Usuário</th>
                <th>Cliente</th>
                <th>Data_Inicio</th>
                <th>Data_Fim</th>
                <th>Valor_Total</th>
            </tr>
        <tbody>
            <!--Teste da tabela-->
            @foreach($nomes as $nome)
                <tr>   
                <th>ID</th>
                <th>Veículo</th>
                <td>{{ $nome }}</td>
                <th>Cliente</th>
                <th>Data_Inicio</th>
                <th>Data_Fim</th>
                <th>Valor_Total</th>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
