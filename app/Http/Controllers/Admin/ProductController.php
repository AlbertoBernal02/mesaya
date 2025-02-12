<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'categories_id' => 'required|integer',
            'total_price' => 'required|numeric',
            'image' => 'nullable|image',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->categories_id = $request->categories_id;
        $product->total_price = $request->total_price;

        // Subir la imagen
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
            $imagePath = '../../img/' . $imageName;
        } else {
            $imagePath = '../../img/default.png';
        }

        // ASIGNAR LA IMAGEN ANTES DE GUARDAR
        $product->image = $imagePath;

        $product->save();

        return redirect()->route('home')->with('success', 'Product created successfully.');
    }
}
