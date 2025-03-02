<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('discounts')->insert([
            ['discount_code' => 'WELCOME10', 'percentage' => 10, 'expiry_date' => '2025-12-31'],
            ['discount_code' => 'CENA2X1', 'percentage' => 50, 'expiry_date' => '2025-08-31'],
            ['discount_code' => 'VEGANO20', 'percentage' => 20, 'expiry_date' => '2025-07-01'],
        ]);
    }
}