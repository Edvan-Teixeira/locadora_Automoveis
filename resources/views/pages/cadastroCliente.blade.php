@extends('layouts.app')

@section('content')
<div class="container mt-3">
        <form>
            <div class="row">
            <div class="col-6">
            <div class="mb-3">
                <label for="nomeFor" class="col-form-label">Nome</label>
                <p class="border border-primary">
                    <input type="nome" class="form-control" id="nomeFor" aria-describedby="nomeHelp">
                </p>
            </div>
            </div>
            <div class="col-6">
            <div class="mb-3">
                <label for="sobrenomeFor" class="col-form-label">Sobrenome</label>
                <p class="border border-primary">
                    <input type="sobrenome" class="form-control" id="sobrenomeFor" aria-describedby="sobrenomeHelp">
                </p>
            </div>
            </div>
            <div class="col-8">
            <div class="mb-3">
                <label for="InputEmail1" class="col-form-label">Email</label>
                <p class="border border-primary">
                    <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp">
                </p>
                    <div id="emailHelp" class="form-text">Email não será revelado.</div>
            </div>
            </div>
            <div class="col-4">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="col-form-label">Senha</label>
                <p class="border border-primary">
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </p>
            </div>
            </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input border border-primary" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <div class="mb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
