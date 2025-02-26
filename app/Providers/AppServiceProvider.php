<?php

namespace App\Providers;

use Laravel\Fortify\Fortify;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot()
    {
    
    // Verifica si hay un idioma en la URL, si no usa el de la sesión o español por defecto
    $locale = Request::query('lang', Session::get('locale', 'es'));

    if (in_array($locale, ['es', 'en'])) {
        App::setLocale($locale);
        Session::put('locale', $locale);} 
  


        Fortify::loginView(function () {
            return view('auth.login'); // Asegúrate de tener esta vista
        });

        Fortify::registerView(function () {
            return view('auth.register'); // Asegúrate de tener esta vista
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        Fortify::resetPasswordView(function () {
            return view('auth.reset-password');
        });
    }
}
