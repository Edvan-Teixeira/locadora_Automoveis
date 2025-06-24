<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.x/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>@yield('title','Meu App')</title>
</head>
<body>
  <div class="container py-4">

    {{-- Sucesso e erro genérico --}}
    @if(session('success_message'))
      <div class="alert alert-success alert-dismissible fade show">
        {{ session('success_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    @if(session('error_message'))
      <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    @auth
        @include('includes.header')
    @endauth

    <div class="container py-4">
        @yield('content')
    </div>

    @auth
        @include('includes.footer')
    @endauth
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.x/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
