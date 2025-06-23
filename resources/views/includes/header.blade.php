<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom" style="text-align: center; padding: 20px; border-bottom: 1px solid #ccc;">
      <a href="{{ route('home') }}" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><img src="{{ asset('images/car2.png') }}" alt="Art" id="logo" class="img-fluid" width="100px"></svg>
      </a>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="{{ route('home') }}" class="nav-link px-2 link-secondary">Home</a></li>
        <li><a href="{{ route('teste') }}" class="nav-link px-2 link-dark">Testes</a></li>
        <li><a href="{{ cadastroCliente') }}" class="nav-link px-2 link-dark">Cadastros</a></li>
      </ul>

      <div class="col-md-3 text-end">
        <a href="{{ route('singIN') }}" class="btn btn-outline-primary me-2">Login</a>s
      </div>
    </header>
  </div>