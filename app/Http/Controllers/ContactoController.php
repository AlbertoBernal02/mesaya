<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactoMailable;
use App\Models\User;

class ContactoController extends Controller
{
    public function index()
    {
        // Obtiene el usuario autenticado
        $usuario = Auth::user();

        // Cuenta las reservas pendientes
        $reservasPendientes = Reserva::where('user_id', $usuario->id)->count();

        // Decuelve la vista contacto
        return view('contacto', compact('reservasPendientes', 'usuario'));
    }

    public function enviarMensaje(Request $request)
    {
        // Valida los datos
        $request->validate([
            'asunto' => 'required|string|max:255',
            'mensaje' => 'required|string',
        ]);

        // Obteniene el usuario autenticado
        $usuario = Auth::user();

        // Obtiene el correo del admin
        $admin = User::where('role', 'admin')->first();

        if ($admin) {
            $datos = [
                'nombre' => $usuario->name,
                'email' => $usuario->email,
                'asunto' => $request->asunto,
                'mensaje' => $request->mensaje,
            ];

            // Envía un email al administrador
            Mail::to($admin->email)->send(new ContactoMailable($datos));

            // Decuelve la vista anterior y un mensaje de éxito
            return back()->with('success', 'Mensaje enviado con éxito, nos pondremos en contacto con usted lo antes posible.');
        }

        // Decuelve la vista anterior y un mensaje de error
        return back()->with('error', 'No se encontró un administrador para recibir el mensaje.');
    }
}