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
