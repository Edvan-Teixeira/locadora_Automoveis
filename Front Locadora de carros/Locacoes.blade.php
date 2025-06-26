@extends('layouts.app')

@section('content')
<div class="container p-4" style="max-width: 520px; background-color: #ffffff; padding: 35px; border-radius: 14px; box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);">
<h3 class="mb-4">Cadastro de Locações</h3>
<form id="formCadastro">
    <div class="row">
        <div class="col-12 mb-3">
        <label for="cliente" class="form-label">Cliente</label>
        <input type="text" class="form-control" id="cliente" name="cliente" required />
      </div>

      

      <div class="col-12 mb-3">
        <label for="usuario" class="form-label">Usuário</label>
        <input type="text" class="form-control" id="usuario" name="usuario" required />
      </div>
      </div>

      <div class="row">
      <div class="mb-3 col-6">
        <label for="dataIN" class="form-label">Data de Inicio</label>
        <input type="text" class="form-control" id="dataIN" name="dataIN" required />
      </div>

      <div class="mb-3 col-6">
        <label for="dataOUT" class="form-label">Data Final</label>
        <input type="text" class="form-control" id="dataOUT" name="dataOUT" required />
      </div>
      </div>
      <div class="row">
      <div class="col-6 mb-3">
        <label for="veiculo" class="form-label">Veículo</label>
        <input type="text" class="form-control" id="veiculo" name="veiculo" required />
      </div>

      <div class="mb-3 col-4">
        <label for="valor" class="form-label">Valor Total</label>
        <input type="text" class="form-control" id="valor" name="valor" required />
      </div>
      </div>

      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>
@endsection
