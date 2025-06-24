<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocacaoController;
use App\Http\Controllers\VeiculoController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group( function () {
    Route::get('/account/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/account/register', [AuthController::class, 'register']);

    Route::get('/account/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/account/login', [AuthController::class, 'authenticate']);
});
Route::get('/home', function () {
    return view('pages.home');
})->name('home');

Route::get('/clientes', function () {
    return view('pages.clientes');
})->name('clientes');

    Route::get('/account/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('/singIN', function () {
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('landing');
    })->name('landing');

    Route::get('/account/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/account/register', [AuthController::class, 'register']);

    Route::get('/account/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/account/login', [AuthController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    Route::get('/account/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/financeiro', [FinanceiroController::class, 'index'])->name('financeiro');


    Route::get('/veiculos', [VeiculoController::class, 'index'])->name('veiculos');
    Route::get('/veiculos/cadastro', [VeiculoController::class, 'create'])->name('veiculos.cadastro');
    Route::post('/veiculos', [VeiculoController::class, 'store'])->name('veiculos.store');
    Route::get('/veiculos/{veiculo}', [VeiculoController::class, 'show'])->name('veiculos.show');
    Route::get('/veiculos/{veiculo}/edit', [VeiculoController::class, 'edit'])->name('veiculos.edit');
    Route::put('/veiculos/{veiculo}', [VeiculoController::class, 'update'])->name('veiculos.update');
    Route::delete('/veiculos/{veiculo}', [VeiculoController::class, 'destroy'])->name('veiculos.destroy');

    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes');
    Route::get('/clientes/cadastro', [ClienteController::class, 'create'])->name('clientes.cadastro');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
    Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

    Route::get('/locacoes', [LocacaoController::class, 'index'])->name('locacoes');
    Route::get('/locacoes/cadastro', [LocacaoController::class, 'create'])->name('locacoes.create');
    Route::post('/locacoes', [LocacaoController::class, 'store'])->name('locacoes.store');
    Route::get('/locacoes/{locacao}', [LocacaoController::class, 'show'])->name('locacoes.show');
    Route::get('/locacoes/{locacao}/edit', [LocacaoController::class, 'edit'])->name('locacoes.edit');
    Route::put('/locacoes/{locacao}', [LocacaoController::class, 'update'])->name('locacoes.update');
    Route::delete('/locacoes/{locacao}', [LocacaoController::class, 'destroy'])->name('locacoes.destroy');
});
