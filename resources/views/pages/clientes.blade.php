@extends('layouts.app')

@section('content')
@php
    $nomes = ['João', 'Maria', 'Pedro'];
@endphp
    <div class="container p-4">
        <table class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Celular</th>
            </tr>
        <tbody>
            <!--Teste da tabela-->
            @foreach($nomes as $nome)
                <tr>
                    <th></th>
                    <td>{{ $nome }}</td>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
