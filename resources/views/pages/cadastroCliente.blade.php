@extends('layouts.app')

@section('content')
    <div class="container p-4">
    <main style="width: 100%; max-width: 330px; padding: 15px; margin: auto;">
  <form>
    <div class="form-floating">
      <input type="nome" class="form-control" id="floatingNome">
      <label for="floatingNome">Nome completo</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Senha</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Cadastrar</button></li>
  </form>
    </div>
</main>
@endsection
