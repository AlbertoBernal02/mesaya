<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if ($request->has('lang')) {
            $lang = $request->query('lang');
            if (in_array($lang, ['es', 'en'])) {
                App::setLocale($lang);
                session(['locale' => $lang]); // Guardamos el idioma en la sesión
            }
        } else {
            App::setLocale(session('locale', 'es')); // Si no hay idioma en la URL, usamos el de la sesión
        }

        return $next($request);
    }
}