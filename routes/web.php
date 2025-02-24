<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\CarritoReservaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\NosotrosController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\RestaurantReservaController;

use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

// 🟢 Rutas de autenticación con Fortify (Bloqueadas para usuarios autenticados con `guest`)
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

// 🟢 Rutas de verificación de email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/')->with('message', 'Tu correo ha sido verificado correctamente.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    if ($request->user()->hasVerifiedEmail()) {
        return redirect()->route('home');
    }

    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Se ha enviado un nuevo correo de verificación.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// 🛑 Todas las rutas privadas requieren autenticación y email verificado
Route::middleware(['auth', 'verified'])->group(function () {
    // 🟢 Rutas de horarios
    Route::get('/get-schedule', [ScheduleController::class, 'getSchedule'])->name('get-schedule');
    Route::get('/schedules', [ScheduleController::class, 'index1'])->name('schedules.index1');
    Route::post('/schedules/store', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::post('/schedules/unavailable', [ScheduleController::class, 'updateUnavailableHours'])->name('schedule.unavailable');

    // 🟢 Rutas del carrito
    Route::get('/cliente/carrito', [CarritoReservaController::class, 'index'])->name('carrito.index');
    Route::post('/cliente/carrito/confirmar', [CarritoReservaController::class, 'confirmarReservas'])->name('carrito.confirmar');
    Route::delete('/carrito/reserva/{id}', [CarritoReservaController::class, 'eliminarReserva'])->name('carrito.eliminar');

    // 🟢 Rutas para reservas (solo usuarios autenticados con rol user)
    Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store')->middleware('role:user');

    // 🟢 Grupo de rutas protegidas para administradores (requieren email verificado)
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', ProductController::class);
        Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    });

    // 🟢 Grupo de rutas protegidas para restaurantes (requieren email verificado)
    Route::middleware(['restaurant'])->prefix('restaurant')->name('restaurant.')->group(function () {
        Route::resource('products', ProductController::class);
    });

    // 🟢 Rutas generales protegidas
  // 🟢 Rutas de contacto (permitido solo para users y restaurants, no para admins)
Route::get('/contacto', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('home')->with('error', 'Los administradores no pueden acceder a la sección de contacto.');
    }
    return app()->call('App\Http\Controllers\ContactoController@index');
})->name('contacto')->middleware('auth');

Route::post('/contacto/enviar', function (Request $request) {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('home')->with('error', 'Los administradores no pueden enviar mensajes de contacto.');
    }
    return app()->call('App\Http\Controllers\ContactoController@enviarMensaje', ['request' => $request]);
})->name('contacto.enviar')->middleware('auth');

    Route::get('/nosotros', [NosotrosController::class, 'index'])->name('nosotros');
});

// 🟢 Rutas públicas (no requieren autenticación)
Route::get('/categories', function (Request $request) {
    return response()->json(Category::all());
});

// 🟢 Página de inicio
Route::get('/', [ProductController::class, 'index'])->name('home');

// 🟢 Redirección después del login según el rol (Bloqueado para usuarios no verificados)
Route::get('/home', function () {
    if (!Auth::check()) {
        return redirect()->route('login'); // Si no está autenticado, lo manda a login
    }

    if (!Auth::user()->email_verified_at) { // Verificación correcta
        Auth::logout(); // Cierra la sesión inmediatamente
        return redirect('/login')->with('message', 'Debes verificar tu correo antes de continuar.');
    }

    return Auth::user()->role == 'restaurant' ? redirect()->route('schedules.index1') : redirect('/');
})->name('home')->middleware(['auth']);

Route::post('/admin/products/restore', [ProductController::class, 'restore'])->name('admin.products.restore');




Route::middleware(['auth', 'role:restaurant'])->group(function () {
    Route::get('/restaurant/reservas', [RestaurantReservaController::class, 'verReservas'])->name('restaurant.reservas');
});