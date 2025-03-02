<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;

class NosotrosController extends Controller
{
    public function index()
    {
        // Cuenta las reservas pendientes para el usuario autenticado
        $reservasPendientes = Reserva::where('user_id', Auth::id())->count();

        // Decuelve la vista nosotros
        return view('nosotros', compact('reservasPendientes'));
    }
}