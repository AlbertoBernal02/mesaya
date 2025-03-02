<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestauranteMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Comprobamos si el usuario está autenticado y si tiene el rol de 'usuario'
        if (Auth::check() && Auth::user()->role == 'restaurant') {
            return $next($request);
        }

        // Si no cumple la condición, redirigimos al inicio
        return redirect('/');
    }
}