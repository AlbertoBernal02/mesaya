<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reservas', function () {
    return view('reservas'); //resources/views/reservas.blade.php"
});

Route::get('/contacto', function () {
    return view('contacto'); //resources/views/contacto.blade.php"
});

Route::get('/nosotros', function () {
    return view('nosotros'); //resources/views/nosotros.blade.php"
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
