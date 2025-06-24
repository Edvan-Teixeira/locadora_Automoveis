<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Locadora de Automóveis')</title>

    <!-- Bootstrap CSS (via CDN) -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
        crossorigin="anonymous"
    >

    @stack('styles')
    @vite('resources/css/singIN.css')
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
