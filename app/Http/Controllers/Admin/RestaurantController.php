<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::denies('isAdmin')) {
                abort(403, 'This action is unauthorized.');
            }
            return $next($request);
        });
    }
}