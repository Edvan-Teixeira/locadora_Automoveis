<header class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home') }}">Logo</a>
    <nav class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('teste') }}">Teste</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
      </ul>

      <div class="col-md-3 text-end">
        <a href="{{ route('singIN') }}" class="btn btn-outline-primary me-2">Login</a>
        <a href="{{ route('cadastroCliente') }}" class="btn btn-primary">Cadastrar</a>
      </div>
    </header>
  </div>
