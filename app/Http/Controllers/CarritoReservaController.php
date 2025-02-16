<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\ReservaConfirmada;
use App\Mail\ReservaConfirmada as ReservaConfirmadaMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;  // Importar Mail

class CarritoReservaController extends Controller
{
    // Mostrar el carrito con las reservas del usuario
    public function index()
    {
        // Obtener todas las reservas del usuario
        $reservas = Reserva::where('user_id', Auth::id())->get();

        // Obtener el número de reservas pendientes de confirmación
        $reservasPendientes = $reservas->where('confirmada', false)->count();

        // Pasar el número de reservas pendientes a la vista
        return view('cliente.carrito.index', compact('reservas', 'reservasPendientes'));
    }

    // Confirmar las reservas y moverlas a reservas_confirmadas
    public function confirmarReservas()
    {
        // Obtener las reservas del usuario
        $reservas = Reserva::where('user_id', Auth::id())->get();
        
        $reservasConfirmadasData = []; // Asegurarse de definir la variable

        foreach ($reservas as $reserva) {
            // Obtener el nombre del restaurante desde la tabla 'products' usando el ID
            $restaurante = \App\Models\Product::find($reserva->restaurante);  // 'restaurante' es el ID del restaurante
            $nombreRestaurante = $restaurante ? $restaurante->name : 'Restaurante no encontrado';  // Obtener el nombre o un mensaje si no lo encuentra

            // Crear la reserva confirmada (se activará el evento 'created')
            $reservaConfirmada = ReservaConfirmada::create([
                'user_id' => $reserva->user_id,
                'restaurante' => $nombreRestaurante,
                'fecha' => $reserva->fecha,
                'hora' => $reserva->hora,
                'num_comensales' => $reserva->num_comensales,
            ]);

            // Guardar los datos de la reserva confirmada para enviarlos por correo
            $reservasConfirmadasData[] = $reservaConfirmada;
        }

        // Eliminar las reservas originales
        Reserva::where('user_id', Auth::id())->delete();

        // Enviar el correo con las reservas confirmadas
        Mail::to(Auth::user()->email)->send(new ReservaConfirmadaMail($reservasConfirmadasData));

        return redirect()->route('carrito.index')->with('success', 'Reservas confirmadas exitosamente.');
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
