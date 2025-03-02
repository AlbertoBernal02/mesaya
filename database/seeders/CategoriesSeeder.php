<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Italiana', 'description' => 'Pasta, pizza y más delicias italianas.'],
            ['name' => 'Japonesa', 'description' => 'Sushi, ramen y comida japonesa tradicional.'],
            ['name' => 'Mexicana', 'description' => 'Tacos, burritos y comida mexicana auténtica.'],
            ['name' => 'Española', 'description' => 'Tapas, paella y gastronomía española.'],
            ['name' => 'Vegana', 'description' => 'Opciones 100% vegetales y saludables.'],
        ]);
    }
}