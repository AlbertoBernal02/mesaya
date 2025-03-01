<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $restaurants = Product::all(); // Carga los productos como restaurantes

        if (Auth::check() && Auth::user()->role && Auth::user()->role == 'admin') {
            return view('welcome', compact('restaurants'));
        } else {
            return view('welcome', compact('restaurants'));
        }
    }

    public function contacto()
    {
        // Decuelve la vista contacto
        return view('contacto');
    }

    public function nosotros()
    {
        // Decuelve la vista nosotros
        return view('nosotros');
    }
}