<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {
    use HasFactory;

    protected $table = 'schedules'; // Nombre de la tabla en la base de datos
    protected $fillable = ['product_id', 'opening_time', 'closing_time', 'unavailable_hours'];

    protected $casts = [
        'unavailable_hours' => 'array', // Para guardar y recuperar las horas no disponibles como array
    ];

    public function restaurant() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
