<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Auth;

// Página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Páginas estáticas que ya tienes
Route::get('/reservas', function () {
    return view('reservas');
});

Route::get('/contacto', function () {
    return view('contacto');
});

Route::get('/nosotros', function () {
    return view('nosotros');
});

// Rutas de autenticación (Login, Registro, Reset Password, etc.)
Auth::routes();

// Dashboard después de iniciar sesión
Route::get('/home', [HomeController::class, 'index'])->name('home');

// 🔹 Rutas públicas (ver restaurantes y detalles)
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{id}', [RestaurantController::class, 'show'])->name('restaurants.show');

// Rutas protegidas para administradores
Route::middleware(['auth', 'role:Administrador'])->group(function () {
    Route::get('/admin/restaurants', [RestaurantController::class, 'adminIndex'])->name('admin.restaurants.index');
    Route::get('/admin/restaurants/create', [RestaurantController::class, 'create'])->name('admin.restaurants.create');
    Route::post('/admin/restaurants', [RestaurantController::class, 'store'])->name('admin.restaurants.store');
    Route::get('/admin/restaurants/{id}/edit', [RestaurantController::class, 'edit'])->name('admin.restaurants.edit');
    Route::put('/admin/restaurants/{id}', [RestaurantController::class, 'update'])->name('admin.restaurants.update');
    Route::delete('/admin/restaurants/{id}', [RestaurantController::class, 'destroy'])->name('admin.restaurants.destroy');
});

// 🔹 Rutas para USUARIOS (hacer reservas)
Route::middleware(['auth', 'role:Cliente'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
});
