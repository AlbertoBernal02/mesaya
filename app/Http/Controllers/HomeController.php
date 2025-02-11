<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product; // Cambia Restaurant por Product

class HomeController extends Controller
{
    public function index()
    {
        $restaurants = Product::all(); // Cargar los productos como restaurantes

        if (Auth::check() && Auth::user()->role && Auth::user()->role == 'admin') {
            return view('welcome', compact('restaurants'));
        } else {
            return view('welcome', compact('restaurants'));
        }
    }

    public function contacto()
    {
        return view('contacto'); // Asegúrate de tener una vista llamada 'contacto.blade.php'
    }

    public function nosotros()
    {
        return view('nosotros'); // Asegúrate de tener una vista llamada 'nosotros.blade.php'
    }
}
