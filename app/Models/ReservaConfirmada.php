<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ReservaConfirmada extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'restaurante', 'fecha', 'hora', 'num_comensales'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Evento para reducir la capacidad del restaurante al crear una reserva
    protected static function booted()
    {
        static::created(function ($reserva) {
            // Busca el restaurante por su nombre
            $restaurante = Product::where('name', $reserva->restaurante)->first();

            if ($restaurante) {
                // Resta el número de comensales de la capacidad
                $restaurante->capacity = max(0, $restaurante->capacity - $reserva->num_comensales);
                $restaurante->save();
            }
        });
    }
}