<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            CategoriesSeeder::class,
            ProductsSeeder::class,
            DiscountsSeeder::class,
            OrdersSeeder::class,
            OrderProductsSeeder::class,
            ShoppingCartsSeeder::class,
            ShoppingCartsHasProductsSeeder::class,
            SchedulesSeeder::class,
        ]);
    }
}