<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('order_products')->insert([
            ['orders_id' => 1, 'products_id' => 1, 'quantity' => 2, 'total_price' => 19.98],
        ]);
    }
}