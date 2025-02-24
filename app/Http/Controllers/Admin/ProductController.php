<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Reserva;
use App\Models\User;
use App\Models\Category;

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
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i',
        ]);

        $timestamp = time();
        $tempEmail = "temp_{$timestamp}@mesaya.com";

        // Crear usuario
        $user = User::create([
            'name' => 'restaurant_temp',
            'email' => $tempEmail,
            'password' => bcrypt('temp'),
            'role' => 'restaurant',
            'active' => true,
        ]);

        // Subir imagen
        $imagePath = '../../img/default.png';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
            $imagePath = '../../img/' . $imageName;
        }

        // Crear producto
        $product = Product::create([
            'name' => $request->name,
            'categories_id' => $request->categories_id,
            'total_price' => $request->total_price,
            'capacity' => $request->capacity,
            'ubication' => $request->ubication,
            'image' => $imagePath,
            'user_id' => $user->id,
            'visible' => true,
        ]);

        // Crear horario
        \App\Models\Schedule::create([
            'product_id' => $product->id,
            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
        ]);

        // Actualizar usuario con credenciales únicas
        $username = 'restaurant' . $product->id;
        $user->update([
            'name' => $username,
            'email' => $username . '@mesaya.com',
            'password' => bcrypt($username),
        ]);

        return redirect()->route('home')->with('success', 'Producto y usuario creados correctamente.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
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
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i',
        ]);

        $product->update([
            'name' => $request->name,
            'categories_id' => $request->categories_id,
            'total_price' => $request->total_price,
            'capacity' => $request->capacity,
            'ubication' => $request->ubication,
            'visible' => $request->has('visible'),
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
            $imagePath = '../../img/' . $imageName;
            $product->update(['image' => $imagePath]);
        }

        return redirect()->route('home')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['visible' => false]);

        // Desactivar usuario y modificar email
        $user = User::find($product->user_id);
        if ($user) {
            $user->update([
                'active' => false,
                'email' => 'disabled_' . $user->email,
            ]);
        }

        return redirect()->back()->with('success', 'Restaurante ocultado y usuario desactivado.');
    }

    public function restore(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->update(['visible' => true]);

        $user = User::where('id', $product->user_id)->first();
        if ($user) {
            // Restaurar usuario y email
            $user->update([
                'active' => true,
                'email' => str_replace('disabled_', '', $user->email),
            ]);
        } else {
            // Si el usuario no existe, crearlo nuevamente
            $newUser = User::create([
                'name' => 'restaurant' . $product->id,
                'email' => 'restaurant' . $product->id . '@mesaya.com',
                'password' => bcrypt('restaurant' . $product->id),
                'role' => 'restaurant',
                'active' => true,
            ]);
            $product->update(['user_id' => $newUser->id]);
        }

        return redirect()->back()->with('success', 'Restaurante restaurado y usuario reactivado.');
    }

    public function index()
    {
        $products = Product::where('visible', true)->get();
        $hiddenProducts = Product::where('visible', false)->get();
        $reservasPendientes = Auth::check() ? Reserva::where('user_id', Auth::id())->count() : 0;
        $categories = Category::all();

        return view('welcome', compact('products', 'hiddenProducts', 'reservasPendientes', 'categories'));
    }
}
