<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\ReservaConfirmada;
use Illuminate\Support\Facades\Auth;

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
    $reservas = Reserva::where('user_id', Auth::id())->get();

    foreach ($reservas as $reserva) {
        // Crear la reserva confirmada (se activará el evento 'created')
        ReservaConfirmada::create([
            'user_id' => $reserva->user_id,
            'restaurante' => $reserva->restaurante,
            'fecha' => $reserva->fecha,
            'hora' => $reserva->hora,
            'num_comensales' => $reserva->num_comensales,
        ]);
    }

    // Eliminar las reservas originales
    Reserva::where('user_id', Auth::id())->delete();

    return redirect()->route('carrito.index')->with('success', 'Reservas confirmadas exitosamente.');
}

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
