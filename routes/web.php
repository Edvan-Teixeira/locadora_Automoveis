<?php

use App\Http\Controllers\Auth\AuthController;
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

Route::get('/teste', function () {
    return view('pages.teste');
})->name('teste');

Route::middleware('guest')->group( function () {
    Route::get('/account/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/account/register', [AuthController::class, 'register']);

    Route::get('/account/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/account/login', [AuthController::class, 'authenticate']);
});

Route::middleware('auth')->group( function () {
    Route::get('/home', function () {
        return view('pages.home');
    })->name('home');

    Route::get('/account/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/clientes', function () {
        return view('pages.clientes');
    })->name('clientes');

    Route::get('/', function () {
        return view('pages.singIN');
    })->name('singIN');

    Route::get('/cadasrtoCliente', function () {
        return view('pages.cadastroCliente');
    })->name('cadastroCliente');
});
