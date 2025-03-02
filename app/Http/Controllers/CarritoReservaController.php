<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\ReservaConfirmada;
use App\Models\Product;
use App\Models\User;
use App\Mail\ReservaConfirmada as ReservaConfirmadaMail;
use App\Mail\ReservaRestaurante as ReservaRestauranteMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class CarritoReservaController extends Controller
{
    // Muestra el carrito con las reservas del usuario
    public function index()
    {
        // Obtiene todas las reservas del usuario
        $reservas = Reserva::where('user_id', Auth::id())->paginate(5);

        // Cuenta reservas pendientes de confirmación
        $reservasPendientes = $reservas->where('confirmada', false)->count();

        // Decuelve la vista carrito
        return view('cliente.carrito.index', compact('reservas', 'reservasPendientes'));
    }

    // Confirma las reservas y las envia por correo
    public function confirmarReservas()
    {
        // Busca las reservas
        $reservas = Reserva::where('user_id', Auth::id())->get();
        $reservasConfirmadasData = [];

        foreach ($reservas as $reserva) {
            // Busca el restaurante asociado
            $restaurante = Product::find($reserva->restaurante);
            $nombreRestaurante = $restaurante ? $restaurante->name : 'Restaurante no encontrado';

            // Obtiene el usuario del restaurante
            $usuarioRestaurante = User::find($restaurante->user_id ?? null);

            // Crea la reserva confirmada
            $reservaConfirmada = ReservaConfirmada::create([
                'user_id' => $reserva->user_id,
                'restaurante' => $nombreRestaurante,
                'fecha' => $reserva->fecha,
                'hora' => $reserva->hora,
                'num_comensales' => $reserva->num_comensales,
            ]);

            // Mete las reservas confirmadas en el array
            $reservasConfirmadasData[] = $reservaConfirmada;

            // Envia un correo al restaurante si se encuentra su usuario
            if ($usuarioRestaurante && $usuarioRestaurante->email) {
                Mail::to($usuarioRestaurante->email)->send(new ReservaRestauranteMail($reservaConfirmada));
            }
        }

        // Elimina las reservas temporales
        Reserva::where('user_id', Auth::id())->delete();

        // Envia un correo de confirmación al usuario
        Mail::to(Auth::user()->email)->send(new ReservaConfirmadaMail($reservasConfirmadasData));

        // Decuelve la vista carrito y un mensaje de éxito
        return redirect()->route('carrito.index')->with('success', 'Reserva/as confirmada/as con éxito, la confirmación se mandará a tu correo.');
    }

    // Elimina una reserva
    public function eliminarReserva($id)
    {
        // Busca la reserva
        $reserva = Reserva::findOrFail($id);

        if ($reserva->user_id !== Auth::id()) {
            // Decuelve la vista carrito y un mensaje de error
            return redirect()->route('carrito.index')->with('error', 'No tienes permiso para eliminar esta reserva.');
        }

        // Elimina la reserva
        $reserva->delete();

        // Decuelve la vista carrito y un mensaje de éxito
        return redirect()->route('carrito.index')->with('success', 'Reserva eliminada con éxito.');
    }
}