<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        // Verifica si el usuario está autenticado y si tiene el rol adecuado
        if (!Auth::check() || Auth::user()->role !== $role) {
            return response("No tienes acceso a esta ruta", 403);
            /*return redirect('/');  // Redirige a la página de inicio si no tiene el rol adecuado*/
        }

        return $next($request);
    }
}

