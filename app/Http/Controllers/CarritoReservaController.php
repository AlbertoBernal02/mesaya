<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\ReservaConfirmada;
use App\Models\Product;
use App\Models\User;
use App\Mail\ReservaConfirmada as ReservaConfirmadaMail;
use App\Mail\ReservaRestaurante as ReservaRestauranteMail; // Nuevo mail para el restaurante
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CarritoReservaController extends Controller
{
    // Mostrar el carrito con las reservas del usuario
    public function index()
    {
        // Obtener todas las reservas del usuario
        $reservas = Reserva::where('user_id', Auth::id())->paginate(5);

        // Contar reservas pendientes de confirmación
        $reservasPendientes = $reservas->where('confirmada', false)->count();

        return view('cliente.carrito.index', compact('reservas', 'reservasPendientes'));
    }

    // Confirmar las reservas y enviarlas por correo
    public function confirmarReservas()
    {
        $reservas = Reserva::where('user_id', Auth::id())->get();
        $reservasConfirmadasData = [];

        foreach ($reservas as $reserva) {
            // Buscar el restaurante asociado
            $restaurante = Product::find($reserva->restaurante);
            $nombreRestaurante = $restaurante ? $restaurante->name : 'Restaurante no encontrado';

            // Obtener el usuario del restaurante
            $usuarioRestaurante = User::find($restaurante->user_id ?? null);

            // Crear la reserva confirmada
            $reservaConfirmada = ReservaConfirmada::create([
                'user_id' => $reserva->user_id,
                'restaurante' => $nombreRestaurante,
                'fecha' => $reserva->fecha,
                'hora' => $reserva->hora,
                'num_comensales' => $reserva->num_comensales,
            ]);

            $reservasConfirmadasData[] = $reservaConfirmada;

            // 🔹 Enviar correo al restaurante si se encuentra su usuario
            if ($usuarioRestaurante && $usuarioRestaurante->email) {
                Mail::to($usuarioRestaurante->email)->send(new ReservaRestauranteMail($reservaConfirmada));
            }
        }

        // Eliminar reservas temporales
        Reserva::where('user_id', Auth::id())->delete();

        // 🔹 Enviar correo de confirmación al usuario
        Mail::to(Auth::user()->email)->send(new ReservaConfirmadaMail($reservasConfirmadasData));

        return redirect()->route('carrito.index')->with('success', 'Reservas confirmadas y notificación enviada a los restaurantes.');
    }

    // Eliminar una reserva
    public function eliminarReserva($id)
    {
        $reserva = Reserva::findOrFail($id);

        if ($reserva->user_id !== Auth::id()) {
            return redirect()->route('carrito.index')->with('error', 'No tienes permiso para eliminar esta reserva.');
        }

        $reserva->delete();

        return redirect()->route('carrito.index')->with('success', 'Reserva eliminada correctamente.');
    }
}
