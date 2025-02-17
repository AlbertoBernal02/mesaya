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

Route::middleware(['auth'])->group(function () {
    // Ruta para obtener el horario (GET)
    Route::get('/get-schedule', [ScheduleController::class, 'getSchedule'])->name('get-schedule');
    
    // Ruta para ver el horario (GET) del restaurante
    Route::get('/schedules', [ScheduleController::class, 'index1'])->name('schedules.index1');
    
    // Ruta para crear o actualizar el horario (POST)
    Route::post('/schedules/store', [ScheduleController::class, 'store'])->name('schedule.store');


    // Ruta para actualizar las horas no disponibles (POST)
    Route::post('/schedules/unavailable', [ScheduleController::class, 'updateUnavailableHours'])->name('schedule.unavailable');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cliente/carrito', [CarritoReservaController::class, 'index'])->name('carrito.index');
    Route::post('/cliente/carrito/confirmar', [CarritoReservaController::class, 'confirmarReservas'])->name('carrito.confirmar');
    Route::delete('/carrito/reserva/{id}', [CarritoReservaController::class, 'eliminarReserva'])->name('carrito.eliminar');
});

use App\Http\Controllers\ReservaController;

Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store')->middleware(['auth', 'role:user']);

// Grupo de rutas protegidas para administradores
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});


// Grupo de rutas protegidas para administradores
Route::middleware(['auth', 'restaurant'])->prefix('restaurant')->name('restaurant.')->group(function () {
    Route::resource('products', ProductController::class);
});


Route::get('/categories', function (Request $request) {
    return response()->json(Category::all());
});

Route::get('/contacto', [ContactoController::class, 'index'])->middleware(['auth', 'role:user'])->name('contacto');
Route::get('/nosotros', [NosotrosController::class, 'index'])->middleware(['auth', 'role:user'])->name('nosotros');

Route::middleware(['auth', 'admin'])->group(function () {
    // Ruta para procesar el formulario de creación de producto
    Route::post('admin/products', [ProductController::class, 'store'])->name('products.store');
});

// Página de inicio (welcome.blade.php)
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Rutas de autenticación
Auth::routes();

// Redirección después del login según el rol
Route::get('/home', function () {
    if (Auth::check()) {
        if (Auth::user()->role == 'restaurant') {
            return redirect()->route('schedules.index1');
        }
        return redirect('/');
    }
    return redirect()->route('login');
})->name('home');
