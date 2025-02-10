<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Auth;

// Página de inicio (welcome.blade.php)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');
Route::get('/nosotros', [HomeController::class, 'nosotros'])->name('nosotros');

// Rutas de autenticación
Auth::routes();

// Redirección después del login según el rol
Route::get('/home', function () {
    if (Auth::check()) {
        return redirect('/');
    }
    return redirect()->route('login');
})->name('home');

// Rutas protegidas para ADMINISTRADORES
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Asegúrate de tener una vista llamada 'admin.dashboard'
    })->name('admin.dashboard')->middleware('auth')->can('isAdmin');

    Route::get('/restaurants', [RestaurantController::class, 'adminIndex'])->name('admin.restaurants.index')->middleware('auth')->can('isAdmin');
    Route::get('/restaurants/create', [RestaurantController::class, 'create'])->name('admin.restaurants.create')->middleware('auth')->can('isAdmin');
    Route::post('/restaurants', [RestaurantController::class, 'store'])->name('admin.restaurants.store')->middleware('auth')->can('isAdmin');
    Route::get('/restaurants/{id}/edit', [RestaurantController::class, 'edit'])->name('admin.restaurants.edit')->middleware('auth')->can('isAdmin');
    Route::put('/restaurants/{id}', [RestaurantController::class, 'update'])->name('admin.restaurants.update')->middleware('auth')->can('isAdmin');
    Route::delete('/restaurants/{id}', [RestaurantController::class, 'destroy'])->name('admin.restaurants.destroy')->middleware('auth')->can('isAdmin');
});

// Rutas protegidas para CLIENTES
Route::middleware(['auth', 'can:isClient'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
});

// Ruta de prueba para verificar si el rol funciona correctamente
Route::get('/admin/test', function () {
    return "Ruta protegida correctamente";
})->middleware('auth')->can('isAdmin');
