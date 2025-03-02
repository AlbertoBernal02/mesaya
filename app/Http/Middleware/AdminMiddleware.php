<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Si el ususrio esta verificado y es admin devuelve la próxima respuesta
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }

        // Sino redirije a la ruta principal
        return redirect('/');
    }
}