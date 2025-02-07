<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder {
    public function run(): void {
        DB::table('products')->insert([
            [
                'name' => 'Ristorante Bella Italia',
                'total_price' => 25.99,
                'categories_id' => 1,
                'image' => 'images/restaurantes/bella_italia.jpg',
            ],
            [
                'name' => 'Sushi Kyoto',
                'total_price' => 35.50,
                'categories_id' => 2,
                'image' => 'images/restaurantes/sushi_kyoto.jpg',
            ],
            [
                'name' => 'Taquería El Patrón',
                'total_price' => 18.99,
                'categories_id' => 3,
                'image' => 'images/restaurantes/el_patron.jpg',
            ],
            [
                'name' => 'Casa de Tapas Sevilla',
                'total_price' => 29.99,
                'categories_id' => 4,
                'image' => 'images/restaurantes/casa_tapas.jpg',
            ],
            [
                'name' => 'Green Vegan Bistro',
                'total_price' => 22.50,
                'categories_id' => 5,
                'image' => 'images/restaurantes/green_vegan.jpg',
            ],
        ]);
    }
}
