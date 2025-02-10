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

        if (Auth::check() && Auth::user()->role && Auth::user()->role->role_name == 'Administrador') {
            return view('admin.restaurants', compact('restaurants'));
        } else {
            return view('welcome', compact('restaurants'));
        }
    }
}
