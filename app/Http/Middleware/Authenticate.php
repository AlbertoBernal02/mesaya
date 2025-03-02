<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    // Obtiene la URL a la que debe ser redirigido el usuario si no está autenticado.
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login'); // Redirige al login si el usuario no está autenticado
        }
    }
}