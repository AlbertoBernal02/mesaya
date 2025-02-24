<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RegistersUsers; // 🔹 Agregamos el trait RegistersUsers

use App\Mail\VerifyEmail;
use App\Models\Product;
use App\Models\Reserva;
use App\Models\User;
use App\Models\Category;
use Illuminate\Auth\Events\Registered;

class ProductController extends Controller
{
    use RegistersUsers; // 🔹 Laravel maneja automáticamente la verificación de email

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
            'email' => 'required|email|unique:users,email',
        ]);

        // 🔹 Crear usuario
        $user = $this->create($request->all());

        // 🔹 Disparar evento Registered para la verificación
        event(new Registered($user));

        // 🔹 Subir imagen
        $imagePath = 'img/default.png';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
            $imagePath = '../../img/' . $imageName;
        }

        // 🔹 Crear producto (restaurante) asegurando que se asigne `user_id`
        $product = Product::create([
            'name' => $request->name,
            'categories_id' => $request->categories_id,
            'total_price' => $request->total_price,
            'capacity' => $request->capacity,
            'ubication' => $request->ubication,
            'image' => $imagePath,
            'user_id' => $user->id, // 🔹 Aquí nos aseguramos de asignarlo correctamente
            'visible' => true,
        ]);

        // Crear horario
        \App\Models\Schedule::create([
            'product_id' => $product->id,
            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
        ]);

        return redirect()->route('home')->with('success', 'Restaurante y usuario creados correctamente. Se ha enviado un email de verificación.');
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make('password123'),
            'role' => 'restaurant',
            'active' => true,
        ]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        // Verificar permisos
        if (Auth::user()->role === 'restaurant' && Auth::id() !== $product->user_id) {
            return redirect()->route('home')->with('error', 'No tienes permiso para editar este restaurante.');
        }

        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Verificar permisos
        if (Auth::user()->role === 'restaurant' && Auth::id() !== $product->user_id) {
            return redirect()->route('home')->with('error', 'No tienes permiso para actualizar este restaurante.');
        }

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
            'visible' => $request->input('visible', $product->visible),
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

        // Verificar permisos
        if (Auth::user()->role === 'restaurant' && Auth::id() !== $product->user_id) {
            return redirect()->route('home')->with('error', 'No tienes permiso para ocultar este restaurante.');
        }

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

        // Verificar permisos
        if (Auth::user()->role === 'restaurant' && Auth::id() !== $product->user_id) {
            return redirect()->route('home')->with('error', 'No tienes permiso para restaurar este restaurante.');
        }

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
