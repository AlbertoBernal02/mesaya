<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Muestra el formulario de login
    public function showLoginForm()
    {
        // Decuelve la vista login
        return view('auth.login');
    }

    // Procesa el inicio de sesión
    public function login(Request $request)
    {
        // Valida los datos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intenta autenticar al usuario
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/home');  // Redirige a la página principal o la que tengas configurada
        }

        // Decuelve la vista anterior y un mensaje de error
        return back()->withErrors(['email' => 'Credenciales incorrectas.']);
    }

    // Muestra el formulario de registro
    public function showRegisterForm()
    {
        // Decuelve la vista register
        return view('auth.register');
    }

    // Procesa el registro de usuario
    public function register(Request $request)
    {
        // Valida los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Crea un nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',  // Pone el rol a user por defecto
        ]);

        // Inicia sesión automáticamente
        Auth::login($user);

        // Decuelve la vista home
        return redirect()->route('home');
    }

    // Cierra la sesión
    public function logout()
    {
        // Cierra sesión al usuario
        Auth::logout();
        // Decuelve la vista raiz
        return redirect('/');
    }
}