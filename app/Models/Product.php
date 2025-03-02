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
        'capacity',
        'ubication',
        'user_id',
        'visible',
    ];

    // Relación con categorías
    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id'); // Asegúrate de que 'categories_id' es el nombre correcto del campo en la base de datos
    }

    // Relación con user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con schedule
    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'product_id');
    }
}