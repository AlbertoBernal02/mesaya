<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Mail\VerifyEmail;
use App\Models\Product;
use App\Models\Reserva;
use App\Models\User;
use App\Models\Category;
use Illuminate\Auth\Events\Registered;

class ProductController extends Controller
{
    use RegistersUsers; // Laravel maneja automáticamente la verificación de email

    public function store(Request $request)
    {
        // Valida la entrada
        $request->validate([
            'name' => 'required|string|min:3|max:100|regex:/^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ-]+$/',
            'categories_id' => 'required|integer|exists:categories,id',
            'total_price' => 'required|numeric|min:0|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'capacity' => 'required|integer|min:1|max:500',
            'ubication' => 'required|string|min:3|max:255|regex:/^[a-zA-Z0-9\s,.-]+$/',
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i',
            'email' => 'required|email|max:255|unique:users,email',
        ]);

        // Limpia las entradas
        $cleanedData = [
            'name' => htmlspecialchars($request->name, ENT_QUOTES, 'UTF-8'),
            'ubication' => htmlspecialchars($request->ubication, ENT_QUOTES, 'UTF-8'),
            'email' => filter_var($request->email, FILTER_SANITIZE_EMAIL),
            'total_price' => filter_var($request->total_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'capacity' => filter_var($request->capacity, FILTER_SANITIZE_NUMBER_INT),
        ];

        // Crea el usuario
        $user = $this->create($cleanedData + $request->all());

        // Dispara el evento Registered para la verificación
        event(new Registered($user));

        // Sube la imagen
        $imagePath = 'img/default.png';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
            $imagePath = '../../img/' . $imageName;
        }

        // Crea el restaurante
        $product = Product::create([
            'name' => $cleanedData['name'],
            'categories_id' => $request->categories_id,
            'total_price' => $cleanedData['total_price'],
            'capacity' => $cleanedData['capacity'],
            'ubication' => $cleanedData['ubication'],
            'image' => $imagePath,
            'user_id' => $user->id,
            'visible' => true,
        ]);

        // Crea el horario
        \App\Models\Schedule::create([
            'product_id' => $product->id,
            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
        ]);

        // Devuelve la vista anterior y un mensaje de éxito
        return redirect()->back()->with('success', 'Restaurante creado con éxito. Se ha enviado un email de verificación al restaurante para que confirme su cuenta. Nada mas que el restaurante confirme su cuenta deberá darle a "¿Olvidaste tu contraseña?" para elegir su contraseña de acceso.');
    }

    protected function create(array $data)
    {
        // Crea el usuario
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
        // Busca el producto
        $product = Product::findOrFail($id);

        // Verifica los permisos
        if (Auth::user()->role === 'restaurant' && Auth::id() !== $product->user_id) {
            return redirect()->route('home')->with('error', 'No tienes permiso para editar este restaurante.');
        }

        // Coge todas las categorías
        $categories = Category::all();

        // Devuelve la vista de admin.products.edit
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Busca el producto
        $product = Product::findOrFail($id);

        if (Auth::user()->role === 'restaurant' && Auth::id() !== $product->user_id) {
            // Devuelve la vista de home y un mensaje de error
            return redirect()->route('home')->with('error', 'No tienes permiso para actualizar este restaurante.');
        }

        // Valida los datos
        $request->validate([
            'name' => 'required|string|min:3|max:100|regex:/^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ-]+$/',
            'categories_id' => 'required|integer|exists:categories,id',
            'total_price' => 'required|numeric|min:0|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'capacity' => 'required|integer|min:1|max:500',
            'ubication' => 'required|string|min:3|max:255|regex:/^[a-zA-Z0-9\s,.-]+$/',
            'opening_time' => 'nullable|string',
            'closing_time' => 'nullable|string',
            'unavailable_hours' => 'nullable|array',
        ]);

        // Obtiene los horarios previos del restaurante
        $schedule = \App\Models\Schedule::where('product_id', $product->id)->first();

        // Si los horarios de apertura y cierre son nulos los pone por defecto
        $opening_time = $request->opening_time ?? ($schedule ? $schedule->opening_time : '09:00');
        $closing_time = $request->closing_time ?? ($schedule ? $schedule->closing_time : '23:00');

        // Actualiza los datos del restaurante
        $product->update([
            'name' => htmlspecialchars($request->name, ENT_QUOTES, 'UTF-8'),
            'categories_id' => $request->categories_id,
            'total_price' => $request->total_price,
            'capacity' => $request->capacity,
            'ubication' => htmlspecialchars($request->ubication, ENT_QUOTES, 'UTF-8'),
            'visible' => $request->input('visible', $product->visible),
        ]);

        // Busca la imagen si existe
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

        // Actualiza o crea el horario en la tabla Schedule
        \App\Models\Schedule::updateOrCreate(
            ['product_id' => $product->id], // Busca por el ID del restaurante
            [
                'opening_time' => $opening_time,
                'closing_time' => $closing_time,
                'unavailable_hours' => $request->unavailable_hours ?? [],
            ]
        );

        // Devuelve la vista de home y un mensaje de éxito
        return redirect()->route('home')->with('success', 'Producto actualizado correctamente.');
    }



    public function destroy($id)
    {
        // Busca el producto
        $product = Product::findOrFail($id);

        // Verifica los permisos
        if (Auth::user()->role === 'restaurant' && Auth::id() !== $product->user_id) {
            // Devuelve la ruta home y un mensaje de error
            return redirect()->route('home')->with('error', 'No tienes permiso para ocultar este restaurante.');
        }

        // Actualiza el estado del producto
        $product->update(['visible' => false]);

        // Desactiva el usuario y modifica el email
        $user = User::find($product->user_id);
        if ($user) {
            $user->update([
                'active' => false,
                'email' => 'disabled_' . $user->email,
            ]);
        }

        // Devuelve la vista anterior y un mensaje de éxito
        return redirect()->back()->with('success', 'Restaurante aliminado con éxito, si en algún futuro te gustaría recuperarlo, sólo le tendrías que dar a "Restaurar Restaurante".');
    }

    public function restore(Request $request)
    {
        // Busca el producto
        $product = Product::findOrFail($request->product_id);

        // Verifica los permisos
        if (Auth::user()->role === 'restaurant' && Auth::id() !== $product->user_id) {
            return redirect()->route('home')->with('error', 'No tienes permiso para restaurar este restaurante.');
        }

        // Actualiza el estado del producto
        $product->update(['visible' => true]);

        // Busca el usuario
        $user = User::where('id', $product->user_id)->first();
        if ($user) {
            // Restaura el usuario y el email
            $user->update([
                'active' => true,
                'email' => str_replace('disabled_', '', $user->email),
            ]);
        } else {
            // Si el usuario no existe, lo crea nuevamente
            $newUser = User::create([
                'name' => 'restaurant' . $product->id,
                'email' => 'restaurant' . $product->id . '@mesaya.com',
                'password' => bcrypt('restaurant' . $product->id),
                'role' => 'restaurant',
                'active' => true,
            ]);

            //Actualiza el producto
            $product->update(['user_id' => $newUser->id]);
        }

        // Devuelve la vista anterior y un mensaje de éxito
        return redirect()->back()->with('success', 'Restaurante restaurado con éxito.');
    }

    public function index()
    {
        // Busca los productos visibles
        $products = Product::where('visible', true)->paginate(6);
        $hiddenProducts = Product::where('visible', false)->get();
        $reservasPendientes = Auth::check() ? Reserva::where('user_id', Auth::id())->count() : 0;
        $categories = Category::all();

        // Devuelve la vista welcome
        return view('welcome', compact('products', 'hiddenProducts', 'reservasPendientes', 'categories'));
    }
}