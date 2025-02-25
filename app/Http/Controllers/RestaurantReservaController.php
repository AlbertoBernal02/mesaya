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
        // Obtener el restaurante que pertenece al usuario autenticado
        $restaurante = Product::where('user_id', Auth::id())->first();

        if (!$restaurante) {
            return redirect()->route('home')->with('error', 'No tienes un restaurante asignado.');
        }

        // Obtener reservas confirmadas usando el nombre del restaurante
        $reservas = ReservaConfirmada::where('restaurante', $restaurante->name)->paginate(10);

        return view('restaurant.reservas.index', compact('reservas'));
    }
}
