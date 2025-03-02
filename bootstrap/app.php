<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UsuarioMiddleware;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\CarritoReservaController;
use App\Http\Middleware\RestauranteMiddleware;
use App\Http\Controllers\ScheduleController;
use App\Providers\FortifyServiceProvider;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders([
        FortifyServiceProvider::class, // Asegura que Fortify se cargue
    ])  
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'admin' => AdminMiddleware::class,
            'usuario' => UsuarioMiddleware::class,
            'reserva' => ReservaController::class,
            'carritoReserva' => CarritoReservaController::class,
            'restaurant' => RestauranteMiddleware::class,
            'get-schedule' => ScheduleController::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();