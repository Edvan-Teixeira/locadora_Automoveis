{{-- resources/views/landing.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>@yield('title', 'Bem-vindo')</title>
  <style>
    body, html { height: 100%; margin: 0; }
    .split { height: 100%; position: fixed; width: 50%; top: 0; }
    .left {
      left: 0;
      background: #F4F7FA;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #333;
      flex-direction: column;
    }
    .left-content img {
      max-width: 80%;
      border-radius: 8px;
      margin-bottom: 1rem;
    }
    .right {
      right: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .btn-group-vertical .btn { margin: 0.5rem 0; width: 12rem; }
  </style>
</head>
<body>
  <div class="split left">
    <div class="left-content text-center">
      <h2 class="fw-bold">Bem-vindo</h2>
      <p class="px-3" style="max-width: 16rem;">Subtítulo aqui.</p>
    </div>
  </div>

  <div class="split right">
    <div class="text-center">
      <h3 class="mb-4">Acesse sua conta</h3>
      <div class="btn-group-vertical">
        <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
        <a href="{{ route('register') }}" class="btn btn-primary">Cadastrar</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
