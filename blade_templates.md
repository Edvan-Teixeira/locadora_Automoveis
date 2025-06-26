# Tutorial de Blade Templates para Quem Sabe Apenas HTML e Bootstrap

Este tutorial é voltado para desenvolvedores que conhecem apenas HTML comum e Bootstrap. Aqui você aprenderá o que são Blade Templates, como se diferenciam de HTML puro e como integrá-los com frameworks de CSS e componentes JS.

---

## 1. O que é Blade?

* **Blade** é o motor de templates padrão do Laravel.
* Permite misturar HTML e PHP de forma limpa, usando diretivas (`@algo`) em vez de tags PHP cruas.
* **Vantagens sobre HTML puro**:

  * **Reutilização** de layouts (herança de templates).
  * **Componentes** e **includes** facilitam a manutenção.
  * **Escapamento automático** de variáveis para proteger contra XSS.

---

## 2. Estrutura de Arquivos

No Laravel, os arquivos Blade ficam em `resources/views/` e têm extensão `.blade.php`.

```
resources/views/
├── layouts/
│   └── app.blade.php   ← Template base (layout principal)
├── includes/
│   └── header.blade.php ← Cabeçalho reutilizável
├── pages/
│   └── home.blade.php   ← Página específica
└── components/
    └── alert.blade.php  ← Componente customizado
```

Essa organização é similar a criar pastas de partials e componentes em projetos front-end com HTML/Bootstrap.

---

## 3. Herança de Layouts

### HTML puro + Bootstrap

```html
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
  <header><!-- navbar --></header>
  <main><!-- conteúdo específico --></main>
  <footer><!-- rodapé --></footer>
</body>
</html>
```

### Com Blade

```blade
<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
  <title>@yield('title', 'Minha App')</title>
</head>
<body>
  @include('includes.header')

  <main class="container mt-4">
    @yield('content')
  </main>

  @include('includes.footer')
  <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
</body>
</html>
```

* **@yield** define pontos de injeção de conteúdo.
* **@include** importa partials (semelhante a `<?php include ?>`).

---

## 4. Criando Páginas

```blade
<!-- resources/views/pages/home.blade.php -->
@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')
  <div class="jumbotron">
    <h1 class="display-4">Bem-vindo!</h1>
    <p class="lead">Este é um exemplo com Bootstrap e Blade.</p>
  </div>
@endsection
```

* **@extends** herda o layout.
* **@section** e **@endsection** preenchem seções definidas por `@yield`.

---

## 5. Diretivas Essenciais

| Diretiva                         | Descrição                                        | Exemplo                                               |
| -------------------------------- | ------------------------------------------------ | ----------------------------------------------------- |
| `@extends`                       | Define qual layout este template estende         | `@extends('layouts.app')`                             |
| `@section`                       | Inicia uma seção de conteúdo                     | `@section('content') ... @endsection`                 |
| `@yield`                         | Ponto de injeção no layout                       | `@yield('content')`                                   |
| `@include`                       | Inclui um partial ou componente                  | `@include('includes.header')`                         |
| `@component`                     | Inicia um componente customizado                 | `@component('components.alert') ... @endcomponent`    |
| `@if / @elseif / @else / @endif` | Structures condicionais em Blade                 | `@if($user) ... @endif`                               |
| `@foreach / @endforeach`         | Laços de repetição                               | `@foreach($list as $item) ... @endforeach`            |
| `{{ }}`                          | Exibe e escapa variável (safe output)            | `{{ $item->name }}`                                   |
| `{!! !!}`                        | Exibe variável sem escape (raw HTML)             | `{!! $htmlContent !!}`                                |
| `@csrf`                          | Gera o token CSRF em formulários                 | `<form> @csrf ... </form>`                            |
| `@method('PUT')`                 | Informa método HTTP em formulários (PUT, DELETE) | `<form action="..."> @method('PUT') @csrf ...</form>` |

---

## 6. Componentes e Slots

Blade permite criar componentes reutilizáveis com slots:

```blade
<!-- resources/views/components/alert.blade.php -->
<div class="alert alert-{{ $type ?? 'info' }}" role="alert">
  {{ $slot }}
</div>
```

Uso:

```blade
@component('components.alert', ['type' => 'warning'])
  Atenção! Isto é um alerta.
@endcomponent
```

Esse padrão substitui a criação manual de partials e possibilita reutilização maior.

---

## 7. Integração com Bootstrap

Como você já sabe usar classes do Bootstrap no HTML, no Blade basta aplicar as mesmas classes:

```blade
<button class="btn btn-primary">Salvar</button>
<div class="row">
  <div class="col-md-6">Coluna 1</div>
  <div class="col-md-6">Coluna 2</div>
</div>
```

Variáveis e diretivas Blade podem controlar classes, atributos e conteúdos:

```blade
<div class="alert {{ $success ? 'alert-success' : 'alert-danger' }}">
  {{ $message }}
</div>
```

---
