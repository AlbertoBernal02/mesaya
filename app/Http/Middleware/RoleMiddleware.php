<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->role->role_name !== $role) {
            abort(403, 'This action is unauthorized.');
        }

        return $next($request);
    }
}
