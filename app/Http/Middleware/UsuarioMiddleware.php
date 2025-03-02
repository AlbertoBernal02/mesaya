<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Comprobamos si el usuario está autenticado y si tiene el rol de 'usuario'
        if (Auth::check() && Auth::user()->role == 'user') {
            return $next($request);
        }

        // Si no cumple la condición, redirigimos a otra página, por ejemplo, al inicio
        return redirect('/');
    }
}