<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product; // ✅ Importar Product en lugar de Restaurant

class HomeController extends Controller
{
    public function index()
    {
    $restaurants = Product::all(); // Obtener todos los productos (restaurantes)
    return view('welcome', compact('restaurants'));
    }
}
