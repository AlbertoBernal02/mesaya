<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Reserva;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'categories_id' => 'required|integer',
            'total_price' => 'required|numeric',
            'image' => 'nullable|image',
            'capacity' => 'required|integer',
            'ubication' => 'required|string|max:255',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->categories_id = $request->categories_id;
        $product->total_price = $request->total_price;
        $product->capacity = $request->capacity;
        $product->ubication = $request->ubication;

        // Subir la imagen
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
            $imagePath = '../../img/' . $imageName;
        } else {
            $imagePath = '../../img/default.png';
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
            'image' => 'nullable|image',
            'capacity' => 'required|integer',
            'ubication' => 'required|string|max:255',
        ]);

        $product->update([
            'name' => $request->name,
            'categories_id' => $request->categories_id,
            'total_price' => $request->total_price,
            'image' => $request->image,
            'capacity' => $request->capacity,
            'ubication' => $request->ubication,
        ]);

         // Subir la imagen
         if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
            $imagePath = '../../img/' . $imageName;
        } else {
            $imagePath = '../../img/default.png';
        }

        // Asignar la imagen antes de guardar
        $product->image = $imagePath;

        $product->save();

        return redirect()->route('home')->with('success', 'Producto actualizado correctamente.');
    }

    public function index()
    {
        // Obtener productos
        $products = Product::all();

        // Calcular reservas pendientes si el usuario está autenticado
        $reservasPendientes = 0;
        if (Auth::check()) {
            $reservasPendientes = Reserva::where('user_id', Auth::id())->count();
        }

        // Pasar productos y reservas a la vista
        return view('welcome', compact('products', 'reservasPendientes'));
    }
}
