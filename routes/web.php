<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/teste', function () {
    return view('pages.teste');
})->name('teste');

Route::get('/', function () {
    return view('welcome');
});

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
});
