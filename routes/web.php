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
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

// Ruta página de inicio
Route::get('/', function (\Illuminate\Http\Request $request) {
    if ($request->has('lang')) {
        App::setLocale($request->query('lang'));
    }
    return view('welcome');
});

// Rutas de autenticación con Fortify (Usuarios invitados)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

// Rutas de verificación de email
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', fn() => view('auth.verify-email'))->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/')->with('message', 'Tu correo ha sido verificado correctamente.');
    })->middleware(['signed'])->name('verification.verify');
    Route::post('/email/verification-notification', function (Request $request) {
        if (!$request->user()->hasVerifiedEmail()) {
            $request->user()->sendEmailVerificationNotification();
            return back()->with('message', 'Se ha enviado un nuevo correo de verificación.');
        }
        return redirect()->route('home');
    })->middleware('throttle:6,1')->name('verification.send');
});

// Rutas protegidas (Usuarios autenticados y verificados)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Rutas de horarios y product controller
    Route::middleware(['role:restaurant,admin'])->group(function () {
        Route::get('/schedules', [ScheduleController::class, 'index1'])->name('schedules.index1');
        Route::post('/schedules/store', [ScheduleController::class, 'store'])->name('schedule.store');
        Route::post('/schedules/unavailable', [ScheduleController::class, 'updateUnavailableHours'])->name('schedule.unavailable');
        Route::get('/restaurant/reservas', [RestaurantReservaController::class, 'verReservas'])->name('restaurant.reservas');
        Route::middleware(['restaurant'])->prefix('restaurant')->name('restaurant.')->group(function () {
            Route::resource('products', ProductController::class);
        });
    });

    // 🛒 Rutas del carrito (Solo usuarios)
    Route::middleware(['role:user'])->group(function () {
        Route::get('/cliente/carrito', [CarritoReservaController::class, 'index'])->name('carrito.index');
        Route::post('/cliente/carrito/confirmar', [CarritoReservaController::class, 'confirmarReservas'])->name('carrito.confirmar');
        Route::delete('/carrito/reserva/{id}', [CarritoReservaController::class, 'eliminarReserva'])->name('carrito.eliminar');
        Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
    });

    // Rutas para administradores
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', ProductController::class);
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::post('/admin/products/restore', [ProductController::class, 'restore'])->name('products.restore');
    });

    // Rutas de contacto (Solo users y restaurants)
    Route::middleware(['role:user,restaurant'])->group(function () {
        Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');
        Route::post('/contacto/enviar', [ContactoController::class, 'enviarMensaje'])->name('contacto.enviar');
        Route::get('/get-schedule', [ScheduleController::class, 'getSchedule'])->name('get-schedule');
    });

    Route::get('/nosotros', [NosotrosController::class, 'index'])->name('nosotros');
});

// 🌎 Rutas públicas
Route::get('/categories', fn(Request $request) => response()->json(Category::all()));
Route::get('/', [ProductController::class, 'index'])->name('home');

// Redirección login según rol
Route::get('/home', function () {
    if (!Auth::check()) return redirect()->route('login');
    if (!Auth::user()->email_verified_at) {
        Auth::logout();
        return redirect('/login')->with('message', 'Debes verificar tu correo antes de continuar.');
    }
    return Auth::user()->role == 'restaurant' ? redirect()->route('schedules.index1') : redirect('/');
})->name('home');