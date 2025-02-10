<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            abort(403, 'No autenticado');
        }

        $user = Auth::user();

        if (!$user->role) {
            abort(403, 'El usuario no tiene un rol asignado');
        }

        if ($user->role->role_name !== $role) {
            abort(403, 'No tienes permisos para acceder a esta página');
        }

        return $next($request);
    }
}
