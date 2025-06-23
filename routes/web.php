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

Route::get('/cadasrto', function () {
    return view('pages.cadastro');
})->name('cadastro');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
