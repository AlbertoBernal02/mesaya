<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Bloquear acceso si el usuario no ha verificado su email.
     */
    protected function authenticated(Request $request, $user)
    {
        if (!$user->hasVerifiedEmail()) {
            Auth::logout(); // Cierra la sesión inmediatamente
            return redirect('/login')->with('message', 'Debes verificar tu correo antes de continuar.');
        }
    }

    /**
     * Sobrescribir el método de intento de login para bloquear usuarios desactivados.
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Intentar iniciar sesión solo si el usuario está activo
        return Auth::attempt(array_merge($credentials, ['active' => true]));
    }

    /**
     * Sobrescribir el método de respuesta en caso de fallo de autenticación.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        if (\App\Models\User::where('email', $request->email)->where('active', false)->exists()) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => ['Tu cuenta está desactivada. Contacta con el administrador.'],
            ]);
        }

        throw \Illuminate\Validation\ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
}
