<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShoppingCartsSeeder extends Seeder
{
    public function run()
    {
        // Obtener un usuario existente
        $user = DB::table('users')->first(); // Obtiene el primer usuario disponible

        if ($user) { // Verificar si hay usuarios en la base de datos
            DB::table('shopping_carts')->insert([
                'users_id' => $user->id, // Ahora usamos un usuario real
            ]);
        }
    }
}