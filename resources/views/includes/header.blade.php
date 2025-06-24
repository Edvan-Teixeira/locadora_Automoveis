<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom" style="text-align: center; padding: 20px; border-bottom: 1px solid #ccc;">
      <a href="{{ route('home') }}" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><img src="{{ asset('images/car2.png') }}" alt="Art" id="logo" class="img-fluid" width="100px"></svg>
      </a>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="{{ route('home') }}" class="nav-link px-2 link-secondary">Home</a></li>
        <li><a href="{{ route('clientes') }}" class="nav-link px-2 link-dark">Clientes</a></li>
        <li><a href="{{ route('locacoes') }}" class="nav-link px-2 link-dark">Locações</a></li>
        <li><a href="{{ route('cadastroCliente') }}" class="nav-link px-2 link-dark">Cadastro Cliente</a></li>
        <li><a href="{{ route('cadastroCarros') }}" class="nav-link px-2 link-dark">Cadastro Carros</a></li>
      </ul>
      <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="{{ route('singIN') }}">Sign out</a></li>
          </ul>
        </div>
    </header>
  </div>