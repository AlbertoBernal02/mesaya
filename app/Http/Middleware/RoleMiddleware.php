<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            abort(403);
        }

        $userRole = Auth::user()->role;

        if (!in_array($userRole, $roles)) {
            abort(403);
        }

        return $next($request);
    }
}