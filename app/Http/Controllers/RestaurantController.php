<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Usar Product en lugar de Restaurant

class RestaurantController extends Controller
{
    public function adminIndex()
    {
        $this->authorize('isAdmin');
        $restaurants = Product::all();
        return view('admin.restaurants', compact('restaurants'));
    }

    public function create()
    {
        $this->authorize('isAdmin');
        return view('admin.create'); // Asegúrate de que esta vista exista
    }

    public function store(Request $request)
    {
        $this->authorize('isAdmin');
        $request->validate([
            'name' => 'required|string|max:255',
            'total_price' => 'required|numeric',
            'categories_id' => 'required|exists:categories,id',
            'image' => 'required|string'
        ]);

        Product::create($request->all());

        return redirect()->route('admin.restaurants.index')->with('success', 'Restaurante creado correctamente.');
    }

    public function edit($id)
    {
        $this->authorize('isAdmin');
        $restaurant = Product::findOrFail($id);
        return view('admin.edit', compact('restaurant'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('isAdmin');
        $request->validate([
            'name' => 'required|string|max:255',
            'total_price' => 'required|numeric',
            'categories_id' => 'required|exists:categories,id',
            'image' => 'required|string'
        ]);

        $restaurant = Product::findOrFail($id);
        $restaurant->update($request->all());

        return redirect()->route('admin.restaurants.index')->with('success', 'Restaurante actualizado.');
    }

    public function destroy($id)
    {
        $this->authorize('isAdmin');
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.restaurants.index')->with('success', 'Restaurante eliminado.');
    }
}