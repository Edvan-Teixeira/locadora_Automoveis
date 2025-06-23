<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/teste', function () {
    return view('pages.teste');
})->name('teste');

Route::get('/singIN', function () {
    return view('pages.singIN');
})->name('singIN');

Route::get('/cadasrtoCliente', function () {
    return view('pages.cadastroCliente');
})->name('cadastroCliente');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
