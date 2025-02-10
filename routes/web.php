<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Auth;

// Página de inicio (welcome.blade.php)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas de autenticación
Auth::routes();

// Redirección después del login según el rol
Route::get('/home', function () {
    if (Auth::check()) {
        if (Auth::user()->role && Auth::user()->role->role_name === 'Administrador') {
            return redirect()->route('admin.restaurants.index');
        }
        return redirect()->route('home'); // Se queda en la página principal (welcome.blade.php)
    }
    return redirect()->route('login');
})->name('home');

// Rutas protegidas para ADMINISTRADORES
Route::middleware(['auth', 'role:Administrador'])->prefix('admin')->group(function () {
    Route::get('/restaurants', [RestaurantController::class, 'adminIndex'])->name('admin.restaurants.index');
    Route::get('/restaurants/create', [RestaurantController::class, 'create'])->name('admin.restaurants.create');
    Route::post('/restaurants', [RestaurantController::class, 'store'])->name('admin.restaurants.store');
    Route::get('/restaurants/{id}/edit', [RestaurantController::class, 'edit'])->name('admin.restaurants.edit');
    Route::put('/restaurants/{id}', [RestaurantController::class, 'update'])->name('admin.restaurants.update');
    Route::delete('/restaurants/{id}', [RestaurantController::class, 'destroy'])->name('admin.restaurants.destroy');
});

// Rutas protegidas para CLIENTES
Route::middleware(['auth', 'role:Cliente'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
});

// Ruta de prueba para verificar si el middleware funciona correctamente
Route::get('/admin/test', function () {
    return "Ruta protegida correctamente";
})->middleware(['auth', 'role:Administrador']);
