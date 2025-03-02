<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    public function run()
    {
        // Obtener un usuario existente
        $user = DB::table('users')->first(); // Obtiene el primer usuario disponible

        if ($user) { // Verificar si hay usuarios en la base de datos
            DB::table('orders')->insert([
                'order_date' => now(),
                'total_price' => 35.99,
                'users_id' => $user->id, // ✅ Ahora usamos un usuario real
            ]);
        }
    }
}