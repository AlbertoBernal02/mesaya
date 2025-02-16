<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller {
    public function index(Request $request)
{
    // Obtener el restaurant_id desde el parámetro de la consulta (URL)
    $restaurantId = $request->query('restaurant_id');
    
    // Buscar el restaurante por el ID del usuario autenticado
    $restaurant = Product::where('user_id', Auth::id())->first();

    // Verificar si el restaurante existe y si el ID coincide
    if (!$restaurant || $restaurant->id != $restaurantId) {
        return response()->json(['message' => 'No se encuentra el restaurante o no coincide con el ID proporcionado.'], 404);
    }

    // Obtener el horario del restaurante
    $schedule = $restaurant->schedule;

    // Verificar si se encontró el horario
    if (!$schedule) {
        return response()->json(['message' => 'No se ha encontrado el horario para este restaurante.'], 404);
    }

    // Retornar el horario en formato JSON
    return response()->json($schedule);
}


    public function store(Request $request) {
        $request->validate([
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i|after:opening_time',
        ]);

        $restaurant = Product::where('user_id', Auth::id())->first();

        if (!$restaurant) {
            return redirect()->back()->with('error', 'No tienes un restaurante asignado.');
        }

        Schedule::updateOrCreate(
            ['product_id' => $restaurant->id],
            [
                'opening_time' => $request->opening_time,
                'closing_time' => $request->closing_time,
            ]
        );

        return redirect()->back()->with('success', 'Horario actualizado correctamente.');
    }

    public function updateUnavailableHours(Request $request) {
        $request->validate([
            'unavailable_hours' => 'nullable|array',
        ]);

        $restaurant = Product::where('user_id', Auth::id())->first();

        if (!$restaurant) {
            return redirect()->back()->with('error', 'No tienes un restaurante asignado.');
        }

        $schedule = $restaurant->schedule;
        if ($schedule) {
            $schedule->update([
                'unavailable_hours' => $request->unavailable_hours ?? [],
            ]);
        }

        return redirect()->back()->with('success', 'Horas bloqueadas actualizadas.');
    }

    public function getSchedule(Request $request)
    {
        $restaurantId = $request->query('restaurant_id');
        
        if (!$restaurantId) {
            return response()->json(['message' => 'El ID del restaurante es requerido.'], 400);
        }

        $schedule = Schedule::where('product_id', $restaurantId)->first();
        
        if (!$schedule) {
            return response()->json(['message' => 'No se encuentra la programación para este restaurante.'], 404);
        }

        return response()->json($schedule);
    }
}
