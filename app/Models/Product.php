<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'categories_id',
        'total_price',
        'image',
    ];

    // Modelo Product
public function category()
{
    return $this->belongsTo(Category::class, 'categories_id'); // Asegúrate de que 'categories_id' es el nombre correcto del campo en la base de datos
}
}
