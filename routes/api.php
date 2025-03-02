<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Schedule;
use Illuminate\Support\Facades\Log;

Route::get('/get-schedule', function (Request $request) {
    $restaurantId = $request->query('restaurant_id');

    // Depurar el valor de restaurant_id
    Log::info('restaurant_id: ' . $restaurantId);

    if (!$restaurantId) {
        return response()->json(['message' => 'El ID del restaurante es requerido.'], 400);
    }

    $schedule = Schedule::where('product_id', $restaurantId)->first();

    if (!$schedule) {
        return response()->json(['message' => 'No se encuentra la programación para este restaurante.'], 404);
    }

    return response()->json($schedule);
});