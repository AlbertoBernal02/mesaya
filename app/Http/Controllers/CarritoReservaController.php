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
    $reservas = Reserva::where('user_id', Auth::id())->get();
    return view('cliente.carrito.index', compact('reservas'));
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

}
