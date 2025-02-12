<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProductController;

/*Permisos de ruta*/
Route::get('/contacto', function () {
    return view('contacto');
})->middleware(['auth', 'role:user']);  
/*End Permisos de ruta*/




Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
});


// Página de inicio (welcome.blade.php)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

Route::get('/nosotros', [HomeController::class, 'nosotros']);

// Rutas de autenticación
Auth::routes();

// Redirección después del login según el rol
Route::get('/home', function () {
    if (Auth::check()) {
        return redirect('/');
    }
    return redirect()->route('login');
})->name('home');




// Ruta de prueba para verificar si el rol funciona correctamente
Route::get('/admin/test', function () {
    return "Ruta protegida correctamente";
})->middleware('auth')->can('isAdmin');
