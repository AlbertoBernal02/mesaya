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
        // Obtener usuario autenticado
        $usuario = Auth::user();

        // Contar reservas pendientes
        $reservasPendientes = Reserva::where('user_id', $usuario->id)->count();

        return view('contacto', compact('reservasPendientes', 'usuario'));
    }

    public function enviarMensaje(Request $request)
    {
        $request->validate([
            'asunto' => 'required|string|max:255',
            'mensaje' => 'required|string',
        ]);

        // Obtener usuario autenticado
        $usuario = Auth::user();

        // Obtener el correo del admin
        $admin = User::where('role', 'admin')->first();

        if ($admin) {
            $datos = [
                'nombre' => $usuario->name,
                'email' => $usuario->email,
                'asunto' => $request->asunto,
                'mensaje' => $request->mensaje,
            ];

            Mail::to($admin->email)->send(new ContactoMailable($datos));

            return back()->with('success', 'Mensaje enviado con éxito, nos pondremos en contacto con usted lo antes posible.');
        }

        return back()->with('error', 'No se encontró un administrador para recibir el mensaje.');
    }
}
