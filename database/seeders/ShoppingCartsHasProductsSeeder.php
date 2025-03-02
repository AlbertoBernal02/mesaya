<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShoppingCartsHasProductsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('shopping_carts_has_products')->insert([
            ['shopping_carts_id' => 1, 'products_id' => 1],
        ]);
    }
}