@extends('layouts.app')

@section('content')
<div class="container mt-1">
  <div class="container mt-1" style="max-width: 520px; background-color: #ffffff; padding: 35px; border-radius: 14px; box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);">
    <h3 class="mb-4">Cadastro de Usuário</h3>
    <form id="formCadastro">
    <div class="row">
      <div class="col-12 mb-3">
        <label for="nome" class="form-label">Nome completo</label>
        <input type="text" class="form-control" id="nome" name="nome" required />
      </div>

      <div class="col-12 mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" id="email" name="email" required />
      </div>
      </div>

      <div class="row">
      <div class="col-6 mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input type="text" class="form-control" id="senha" name="senha" required />
      </div>
      </div>

      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
    </div>
    </div>
@endsection
