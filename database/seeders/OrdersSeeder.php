<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder {
    public function run(): void {
        DB::table('orders')->insert([
            [
                'total_price' => 35.99,
                'users_id' => 3, // Cliente Juan Pérez
                'order_date' => now(),
            ],
        ]);
    }
}
