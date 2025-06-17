<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/teste', function () {
    return view('pages.teste');
})->name('teste');

Route::get('/welcome', function () {
    return view('welcome');
});
