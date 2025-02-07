<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShoppingCartsSeeder extends Seeder {
    public function run(): void {
        DB::table('shopping_carts')->insert([
            ['users_id' => 3], // Cliente Juan Pérez tiene un carrito con reservas
        ]);
    }
}
