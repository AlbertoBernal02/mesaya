<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder {
    public function run(): void {
        DB::table('products')->insert([
            [
                'name' => 'Street Food Burguer Porn',
                'total_price' => 20.00,
                'categories_id' => 1,
                'image' => '../../img/foodPorn.jpg',
            ],
            [
                'name' => 'La Mafia Se Sienta A La Mesa',
                'total_price' => 35.50,
                'categories_id' => 2,
                'image' => '../../img/Mafia.png',
            ],
            [
                'name' => 'Maquiavelo',
                'total_price' => 18.99,
                'categories_id' => 3,
                'image' => '../../img/maquiavelo.jpg',
            ],
            [
                'name' => 'Blanca Paloma',
                'total_price' => 29.99,
                'categories_id' => 4,
                'image' => '../../img/blancaPaloma.jpg',
            ],
            [
                'name' => 'Río Grande',
                'total_price' => 22.50,
                'categories_id' => 5,
                'image' => '../../img/rioGrande.jpg',
            ],
            [
                'name' => 'Bilio',
                'total_price' => 20.50,
                'categories_id' => 5,
                'image' => '../../img/bilio.jpg',
            ],
            [
                'name' => 'Abades Triana',
                'total_price' => 20.00,
                'categories_id' => 1,
                'image' => '../../img/abades.jpg',
            ],
            [
                'name' => 'Las Dunas',
                'total_price' => 35.50,
                'categories_id' => 2,
                'image' => '../../img/Dunas.jpg',
            ],
            [
                'name' => 'Taberna Bocanegra',
                'total_price' => 35.50,
                'categories_id' => 2,
                'image' => '../../img/bocanegra.jpg',
            ],
            [
                'name' => 'Taberna Coloniales',
                'total_price' => 35.50,
                'categories_id' => 2,
                'image' => '../../img/coloniales.jpg',
            ],
            [
                'name' => 'Taberna El Arenal',
                'total_price' => 35.50,
                'categories_id' => 2,
                'image' => '../../img/Arenal.jpg',
            ],
            [
                'name' => 'Taberna Antonio Romero',
                'total_price' => 35.50,
                'categories_id' => 2,
                'image' => '../../img/antonioRomero.jpg',
            ],
            [
                'name' => 'Restaurante San Marco (Santa Cruz,Sevilla)',
                'total_price' => 35.50,
                'categories_id' => 2,
                'image' => '../../img/SanMarco.jpg',
            ],
            [
                'name' => 'María Trifulca',
                'total_price' => 35.50,
                'categories_id' => 2,
                'image' => '../../img/mariaTrifulca.jpg',
            ],
            [
                'name' => 'Taberna Almazara',
                'total_price' => 35.50,
                'categories_id' => 2,
                'image' => '../../img/almazara.jpg',
            ],
            [
                'name' => 'Patio San Eloy (Triana)',
                'total_price' => 35.50,
                'categories_id' => 2,
                'image' => '../../img/SanEloyTriana.jpg',
            ],
            [
                'name' => 'Patio San Eloy (Santa Catalina)',
                'total_price' => 35.50,
                'categories_id' => 2,
                'image' => '../../img/SanEloyStaCatalina.jpg',
            ],
            [
                'name' => 'Bar Casemiro',
                'total_price' => 35.50,
                'categories_id' => 2,
                'image' => '../../img/casemiro.jpg',
            ],
            [
                'name' => 'Amanecer (Alameda de Hércules, Sevilla)',
                'total_price' => 35.50,
                'categories_id' => 2,
                'image' => '../../img/amanecer.png',
            ],
            [
                'name' => 'Avelino',
                'total_price' => 35.50,
                'categories_id' => 2,
                'image' => '../../img/avelino.jpg',
            ],
            [
                'name' => 'Aderezo',
                'total_price' => 35.50,
                'categories_id' => 2,
                'image' => '../../img/aderezo.jpg',
            ],
        ]);
    }
}
