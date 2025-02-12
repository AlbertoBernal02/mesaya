<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Category;
use Illuminate\Http\Request;

// Grupo de rutas protegidas para administradores
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});



Route::get('/categories', function (Request $request) {
    return response()->json(Category::all());
});

/*Permisos de ruta*/
Route::get('/contacto', function () {
    return view('contacto');
})->middleware(['auth', 'role:user']);  
/*End Permisos de ruta*/

Route::middleware(['auth', 'admin'])->group(function () {
    // Ruta para procesar el formulario de creación de producto
    Route::post('admin/products', [ProductController::class, 'store'])->name('products.store');
});

// Página de inicio (welcome.blade.php)
Route::get('/', [ProductController::class, 'index'])->name('home');
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
