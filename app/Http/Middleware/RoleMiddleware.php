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
            return response()->view('acceso_denegado', [], 403);
        }

        return $next($request);
    }
}

