<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\CarritoReservaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\NosotrosController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReservaController;

use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;

// Rutas de autenticación Fortify
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');

// Middleware para rutas autenticadas
Route::middleware(['auth'])->group(function () {
    // Rutas de horarios
    Route::get('/get-schedule', [ScheduleController::class, 'getSchedule'])->name('get-schedule');
    Route::get('/schedules', [ScheduleController::class, 'index1'])->name('schedules.index1');
    Route::post('/schedules/store', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::post('/schedules/unavailable', [ScheduleController::class, 'updateUnavailableHours'])->name('schedule.unavailable');

    // Rutas del carrito
    Route::get('/cliente/carrito', [CarritoReservaController::class, 'index'])->name('carrito.index');
    Route::post('/cliente/carrito/confirmar', [CarritoReservaController::class, 'confirmarReservas'])->name('carrito.confirmar');
    Route::delete('/carrito/reserva/{id}', [CarritoReservaController::class, 'eliminarReserva'])->name('carrito.eliminar');
});

// Rutas para reservas (solo usuarios autenticados con rol user)
Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store')->middleware(['auth', 'role:user']);

// Grupo de rutas protegidas para administradores
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
    Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Grupo de rutas protegidas para restaurantes
Route::middleware(['auth', 'restaurant'])->prefix('restaurant')->name('restaurant.')->group(function () {
    Route::resource('products', ProductController::class);
});

// Rutas generales
Route::get('/categories', function (Request $request) {
    return response()->json(Category::all());
});

Route::get('/contacto', [ContactoController::class, 'index'])->middleware(['auth', 'role:user'])->name('contacto');
Route::get('/nosotros', [NosotrosController::class, 'index'])->middleware(['auth', 'role:user'])->name('nosotros');

// Página de inicio (welcome.blade.php)
Route::get('/', [ProductController::class, 'index'])->name('home');

// Redirección después del login según el rol
Route::get('/home', function () {
    if (Auth::check()) {
        return Auth::user()->role == 'restaurant' ? redirect()->route('schedules.index1') : redirect('/');
    }
    return redirect()->route('login');
})->name('home');
