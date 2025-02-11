<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Método para mostrar el formulario de creación (si es necesario)
    public function create()
{
    $categories = Category::all()->toArray();  // Convertir en un array
    return view('products.create', compact('categories'));
}


    // Método para almacenar el producto
    public function store(Request $request)
{
    // Validar los datos del formulario
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'categories_id' => 'required|exists:categories,id',  // Verifica que la categoría exista
        'total_price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Para la imagen del producto
    ]);

    // Subir la imagen si está presente
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('public/products');
    }

    // Crear el producto
    $product = Product::create([
        'name' => $validated['name'],
        'categories_id' => $validated['categories_id'],
        'total_price' => $validated['total_price'],
        'image' => $imagePath ?? null,  // Si no se sube imagen, se guarda como null
    ]);

    // Redirigir al listado de productos o a donde lo desees
    return redirect()->route('products.index')->with('success', 'Producto añadido exitosamente.');
}

}
