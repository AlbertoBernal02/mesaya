<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;

class ReservaController extends Controller
{
    public function store(Request $request)
    {

        // Validar los datos
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'num_comensales' => 'required|integer|min:1|max:10',
        ]);







        // Crear la reserva
        Reserva::create([
            'user_id' => Auth::id(),
            'restaurante' => $request->restaurante, // o toma el restaurante dinámicamente si es necesario
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'num_comensales' => $request->num_comensales,
        ]);

        return redirect()->back()->with('success', 'Reserva realizada con éxito');
        }
}
