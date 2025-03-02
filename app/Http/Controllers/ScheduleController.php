<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ScheduleController extends Controller
{

    public function index(Request $request)
    {
        // Obtiene el restaurant_id desde el parámetro de la consulta (URL)
        $restaurantId = $request->query('restaurant_id');

        // Busca el restaurante por el ID del usuario autenticado
        $restaurant = Product::where('user_id', Auth::id())->first();

        // Verifica si el restaurante existe y si el ID coincide
        if (!$restaurant || $restaurant->id != $restaurantId) {
            return response()->json(['message' => 'No se encuentra el restaurante o no coincide con el ID proporcionado.'], 404);
        }

        // Obtiene el horario del restaurante
        $schedule = $restaurant->schedule;

        // Verifica si se encontró el horario
        if (!$schedule) {
            return response()->json(['message' => 'No se ha encontrado el horario para este restaurante.'], 404);
        }

        // Devuelve el horario en formato JSON
        return response()->json($schedule);
    }




    public function index1(Request $request)
    {
        // Obtener el restaurante del usuario autenticado
        $restaurant = Product::where('user_id', Auth::id())->first();

        // Si el restaurante no existe
        if (!$restaurant) {
            return response()->json(['message' => 'No se encuentra el restaurante asociado al usuario.'], 404);
        }

        // Obtener el horario del restaurante (si existe)
        $schedule = $restaurant->schedule;

        // Devolver la vista con el restaurante y su horario (si existe)
        return view('schedules.index', compact('restaurant', 'schedule'));
    }







    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i',
            'unavailable_hours' => 'nullable|array',
        ]);

        // Obtener el restaurante asociado al usuario autenticado
        $restaurant = Product::where('user_id', Auth::id())->first();

        if (!$restaurant) {
            return redirect()->back()->with('error', 'No tienes un restaurante asignado.');
        }

        // Usamos updateOrCreate para actualizar o crear el horario
        $schedule = Schedule::updateOrCreate(
            ['product_id' => $restaurant->id], // Se asegura que estamos buscando por el ID correcto
            [
                'opening_time' => $request->opening_time,
                'closing_time' => $request->closing_time,
                'unavailable_hours' => $request->unavailable_hours ?? [],
            ]
        );

        // Mensaje de éxito
        return redirect()->back()->with('success', $schedule->wasRecentlyCreated ? 'Horario creado correctamente.' : 'Horario actualizado correctamente.');
    }













    public function updateUnavailableHours(Request $request)
    {
        // Validar horas no disponibles
        $request->validate([
            'unavailable_hours' => 'nullable|array',
        ]);

        // Buscar el restaurante asociado al usuario autenticado
        $restaurant = Product::where('user_id', Auth::id())->first();

        if (!$restaurant) {
            return redirect()->back()->with('error', 'No tienes un restaurante asignado.');
        }

        // Obtener el horario del restaurante
        $schedule = $restaurant->schedule;

        if ($schedule) {
            // Actualizar las horas no disponibles
            $schedule->update([
                'unavailable_hours' => $request->unavailable_hours ?? [],
            ]);
        } else {
            return redirect()->back()->with('error', 'No se ha encontrado el horario del restaurante.');
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