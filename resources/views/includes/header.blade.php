<div class="container">
  <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom" style="border-color: #e0e0e0;">
    <a href="{{ route('home') }}" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
      <img src="{{ asset('images/car2.png') }}" alt="Logo" class="img-fluid" width="100">
    </a>
    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="{{ route('clientes') }}" class="nav-link px-2 link-dark">Clientes</a></li>
      <li><a href="{{ route('veiculos') }}" class="nav-link px-2 link-dark">Veiculos</a></li>
      <li><a href="{{ route('locacoes') }}" class="nav-link px-2 link-dark">Locações</a></li>
    </ul>
    <div class="d-none d-md-block text-muted small mt-2 me-2">
        Saldo: <strong>R$ {{ number_format($saldo ?? 0, 2, ',', '.') }}</strong>
    </div>
    <div class="dropdown text-end">
      <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="Usuário" width="32" height="32" class="rounded-circle">
      </a>
      <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <li><a class="dropdown-item" href="{{ route('logout') }}">Sair</a></li>
      </ul>
    </div>
  </header>
</div>
