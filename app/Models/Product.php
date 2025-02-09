<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // Asegurar que Laravel usa la tabla correcta

    protected $fillable = ['name', 'total_price', 'categories_id', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }
}
