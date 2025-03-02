<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservaConfirmada;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class RestaurantReservaController extends Controller
{
    public function verReservas()
    {
        // Obtiene el restaurante que pertenece al usuario autenticado
        $restaurante = Product::where('user_id', Auth::id())->first();

        if (!$restaurante) {
            // Decuelve la vista home y un mensaje de error
            return redirect()->route('home')->with('error', 'No tienes un restaurante asignado.');
        }

        // Obtiene las reservas confirmadas usando el nombre del restaurante
        $reservas = ReservaConfirmada::where('restaurante', $restaurante->name)->paginate(10);

        // Decuelve la vista reservas
        return view('restaurant.reservas.index', compact('reservas'));
    }
}