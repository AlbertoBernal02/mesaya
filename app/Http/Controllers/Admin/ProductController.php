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
            $imagePath = 'img/' . $imageName;
        } else {
            $imagePath = 'img/default.png';
        }

        // Asignar la imagen antes de guardar
        $product->image = $imagePath;

        $product->save();

        return redirect()->route('home')->with('success', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', 'Producto eliminado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'categories_id' => 'required|integer',
            'total_price' => 'required|numeric',
        ]);

        $product->update([
            'name' => $request->name,
            'categories_id' => $request->categories_id,
            'total_price' => $request->total_price,
        ]);

        return redirect()->route('home')->with('success', 'Producto actualizado correctamente.');
    }

    public function index()
{
    // Obtener productos desde el modelo o base de datos
    $products = Product::all();

    // Pasar la variable a la vista
    return view('welcome', ['products' => $products]);

}
}
