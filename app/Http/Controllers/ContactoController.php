<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;

class ContactoController extends Controller
{
    public function index()
    {
        // Contar las reservas pendientes para el usuario autenticado
        $reservasPendientes = Reserva::where('user_id', Auth::id())->count();

        return view('contacto', compact('reservasPendientes'));
    }
}

