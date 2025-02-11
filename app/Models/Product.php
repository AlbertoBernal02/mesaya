<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'categories_id', 'total_price', 'image'];

    // Relación con categorías
    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }
}
