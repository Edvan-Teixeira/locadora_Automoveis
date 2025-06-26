# Fluxo de Desenvolvimento no Laravel e Arquitetura MVC

Este guia apresenta, em formato passo a passo, o fluxo de criação de uma aplicação no Laravel, ilustrando como cada etapa se relaciona com a arquitetura **MVC** (Model–View–Controller).

---

## 1. Model (Modelagem de Dados)

### 1.1. Migrations

* **O que são?**: Classes que definem o esquema de tabelas no banco de dados.
* **Comando**: `php artisan make:migration create_veiculos_table`
* **Onde se encaixa?**: Parte do *Model*, pois estrutura os dados que serão manipulados.

```php
// exemplo: database/migrations/2025_06_26_000000_create_veiculos_table.php
Schema::create('veiculos', function (Blueprint $table) {
    $table->id();
    $table->string('marca');
    $table->string('modelo');
    $table->integer('ano');
    $table->decimal('custo_diario', 8, 2);
    $table->timestamps();
});
```

### 1.2. Models

* **O que são?**: Classes que representam as tabelas do banco e contêm lógica de acesso a dados.
* **Comando**: `php artisan make:model Veiculo`
* **Onde se encaixa?**: **Model**.

```php
// exemplo: app/Models/Veiculo.php
class Veiculo extends Model
{
    protected $fillable = ['marca','modelo','ano','custo_diario'];
}
```

---

## 2. Controller (Lógica de Aplicação)

### 2.1. Criação de Controller

* **Comando**: `php artisan make:controller VeiculoController --resource`
* **Onde se encaixa?**: **Controller**.
* **Função**: Receber requisições HTTP, manipular modelos e retornar respostas.

```php
// exemplo: app/Http/Controllers/VeiculoController.php
public function index()
{
    $veiculos = Veiculo::all();
    return view('veiculos.index', compact('veiculos'));
}
```

---

## 3. View (Interface com o Usuário)

### 3.1. Blade Templates

* **O que são?**: Arquivos `.blade.php` que geram HTML dinâmico.
* **Localização**: `resources/views/veiculos/index.blade.php`

```blade
{{-- exemplo: resources/views/veiculos/index.blade.php --}}
@extends('layouts.app')

@section('content')
  <h1>Lista de Veículos</h1>
  <ul>
    @foreach($veiculos as $veiculo)
      <li>{{ $veiculo->marca }} - {{ $veiculo->modelo }}</li>
    @endforeach
  </ul>
@endsection
```

---

## 4. Rotas (Definição de Endpoints)

* **Arquivo**: `routes/web.php`
* **Comando (resource)**: `Route::resource('veiculos', VeiculoController::class);`

```php
// exemplo: routes/web.php
Route::get('/', function () {
    return view('welcome');
});
Route::resource('veiculos', VeiculoController::class);
```

---

## 5. Seeders (Dados de Teste)

* **O que são?**: Classes para popular o banco com dados iniciais ou de teste.
* **Comando**: `php artisan make:seeder VeiculoSeeder`

```php
// exemplo: database/seeders/VeiculoSeeder.php
public function run()
{
    Veiculo::factory()->count(10)->create();
}
```

* **Execução**: `php artisan db:seed --class=VeiculoSeeder`

---

## 6. Middlewares (Filtros de Requisição)

* **O que são?**: Camadas que interceptam requisições HTTP antes do Controller.
* **Comando**: `php artisan make:middleware CheckAdmin`
* **Uso**: Registrado em `app/Http/Kernel.php` e aplicado em rotas.

```php
// exemplo: app/Http/Middleware/CheckAdmin.php
public function handle(Request $request, Closure $next)
{
    if (!Auth::user()->is_admin) {
        abort(403);
    }
    return $next($request);
}
```

```php
// aplicação em rota
Route::middleware(['auth','check.admin'])->group(function () {
    Route::resource('veiculos', VeiculoController::class);
});
```

---

## 7. Resumo do Fluxo

1. **Definição de dados**: Criação de migrations → criação de models.
2. **Definição de lógica**: Criação de controllers → ligação com models.
3. **Apresentação**: Definição de rotas → views Blade.
4. **Dados iniciais/testes**: Seeders e factories.
5. **Segurança e filtros**: Middlewares.

Cada elemento se encaixa em uma das camadas **Model**, **View** ou **Controller**, seguindo a filosofia MVC do Laravel.

---

> **Dica**: Utilize `php artisan list` para ver todos os comandos disponíveis e explore a documentação oficial em [https://laravel.com/docs/12.x](https://laravel.com/docs/12.x) para aprofundar cada tópico.
