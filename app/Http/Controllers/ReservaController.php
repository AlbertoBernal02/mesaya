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
        // Valida los datos de entrada
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'num_comensales' => 'required|integer|min:1|max:50',
        ]);

        // Verifica si el validador falla
        if ($validator->fails()) {
            // Decuelve la vista anterior y un mensaje de error
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Limpia los datos
        $cleanedData = [
            'fecha' => htmlspecialchars($request->fecha, ENT_QUOTES, 'UTF-8'),
            'hora' => htmlspecialchars($request->hora, ENT_QUOTES, 'UTF-8'),
            'num_comensales' => filter_var($request->num_comensales, FILTER_SANITIZE_NUMBER_INT),
        ];

        // Crea la reserva
        Reserva::create([
            'user_id' => Auth::id(),
            'restaurante' => $request->restaurante,
            'fecha' => $cleanedData['fecha'],
            'hora' => $cleanedData['hora'],
            'num_comensales' => $cleanedData['num_comensales'],
        ]);

        // Decuelve la vista anterior y un mensaje de éxito
        return redirect()->back()->with('success', 'Reserva realizada con éxito, ve a "Confirmar Reservas" para confirmarla o eliminarla.');
    }
}