<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Reserva;
use App\Models\User;

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

    // Generar un email temporal único
    $timestamp = time(); // Usamos time() para evitar duplicados
    $tempEmail = "temp_{$timestamp}@mesaya.com";

    // Crear el usuario con email único
    $user = new User();
    $user->name = 'restaurant_temp';
    $user->email = $tempEmail;
    $user->password = bcrypt('temp');
    $user->role = 'restaurant';
    $user->save();

    // Subir la imagen o asignar una por defecto
    $imagePath = '../../img/default.png';
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img'), $imageName);
        $imagePath = '../../img/' . $imageName;
    }

    // Crear el producto con el `user_id`
    $product = Product::create([
        'name' => $request->name,
        'categories_id' => $request->categories_id,
        'total_price' => $request->total_price,
        'capacity' => $request->capacity,
        'ubication' => $request->ubication,
        'image' => $imagePath,
        'user_id' => $user->id, // Se asigna el usuario creado
    ]);

    // Actualizar el usuario con el nombre y email correctos basados en el `product->id`
    $username = 'restaurant' . $product->id;
    $user->update([
        'name' => $username,
        'email' => $username . '@mesaya.com', // Ahora es único
        'password' => bcrypt($username), // La contraseña será igual al usuario
    ]);

    return redirect()->route('home')->with('success', 'Producto y usuario creados correctamente.');
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
        'image' => 'nullable|image', // Cambié a nullable para que no sea obligatorio
        'capacity' => 'required|integer',
        'ubication' => 'required|string|max:255',
    ]);

    // Guardar los campos que no son imagen
    $product->name = $request->name;
    $product->categories_id = $request->categories_id;
    $product->total_price = $request->total_price;
    $product->capacity = $request->capacity;
    $product->ubication = $request->ubication;

    // Verificar si se ha subido una nueva imagen
    if ($request->hasFile('image')) {
        // Eliminar la imagen anterior si existe
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image)); // Eliminar la imagen anterior
        }

        // Subir la nueva imagen
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img'), $imageName);
        $imagePath = '../../img/' . $imageName; // Guardar la ruta correcta

        // Asignar la nueva imagen
        $product->image = $imagePath;
    }

    // Guardar los cambios en la base de datos
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
