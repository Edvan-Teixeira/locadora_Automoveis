<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.singIN');
})->name('singIN');

Route::get('/home', function () {
    return view('pages.home');
})->name('home');

Route::get('/clientes', function () {
    return view('pages.clientes');
})->name('clientes');

Route::get('/cadasrtoCliente', function () {
    return view('pages.cadastroCliente');
})->name('cadastroCliente');

Route::get('/cadasrtoCarros', function () {
    return view('pages.cadastroCarros');
})->name('cadastroCarros');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
