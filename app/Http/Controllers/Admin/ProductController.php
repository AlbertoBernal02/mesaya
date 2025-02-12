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

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products');
        }

        $product->save();

        // Cambiar la redirección a una ruta diferente
        return redirect()->route('home')->with('success', 'Product created successfully.');
    }
}
