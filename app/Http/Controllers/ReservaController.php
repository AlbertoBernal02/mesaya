<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Schedule;

class ReservaController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'num_comensales' => 'required|integer|min:1|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Sanitizar los datos usando htmlspecialchars()
        $cleanedData = [
            'fecha' => htmlspecialchars($request->fecha, ENT_QUOTES, 'UTF-8'),
            'hora' => htmlspecialchars($request->hora, ENT_QUOTES, 'UTF-8'),
            'num_comensales' => filter_var($request->num_comensales, FILTER_SANITIZE_NUMBER_INT),
        ];

        // Crear la reserva
        Reserva::create([
            'user_id' => Auth::id(),
            'restaurante' => $request->restaurante,
            'fecha' => $cleanedData['fecha'],
            'hora' => $cleanedData['hora'],
            'num_comensales' => $cleanedData['num_comensales'],
        ]);

        return redirect()->back()->with('success', 'Reserva realizada con éxito.');
    }
}
