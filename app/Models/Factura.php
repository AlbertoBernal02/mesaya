<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = ['reserva_id', 'restaurante', 'monto'];

    // Relación con reserva
    public function reserva()
    {
        return $this->belongsTo(ReservaConfirmada::class, 'reserva_id');
    }
}