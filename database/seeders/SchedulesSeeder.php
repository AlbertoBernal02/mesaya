<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchedulesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('schedules')->insert([
            [
                'product_id' => 1,
                'opening_time' => '09:00:00',
                'closing_time' => '23:00:00',
                'unavailable_hours' => json_encode(['15:00', '16:00']),
                'hourly_capacity' => json_encode([
                    '09:00' => 20,
                    '10:00' => 20,
                    '17:00' => 15,
                    '20:00' => 30
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'opening_time' => '10:00:00',
                'closing_time' => '22:00:00',
                'unavailable_hours' => json_encode(['14:00']),
                'hourly_capacity' => json_encode([
                    '10:00' => 25,
                    '11:00' => 25,
                    '19:00' => 20,
                    '21:00' => 35
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'opening_time' => '12:00:00',
                'closing_time' => '20:00:00',
                'unavailable_hours' => json_encode(['15:30', '16:30']),
                'hourly_capacity' => json_encode([
                    '12:00' => 10,
                    '13:00' => 15,
                    '17:00' => 25,
                    '19:00' => 20
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4,
                'opening_time' => '11:00:00',
                'closing_time' => '21:00:00',
                'unavailable_hours' => json_encode([]),
                'hourly_capacity' => json_encode([
                    '11:00' => 30,
                    '13:00' => 30,
                    '18:00' => 40
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 5,
                'opening_time' => '08:00:00',
                'closing_time' => '20:00:00',
                'unavailable_hours' => json_encode(['12:00', '15:00']),
                'hourly_capacity' => json_encode([
                    '08:00' => 15,
                    '09:00' => 20,
                    '10:00' => 20,
                    '16:00' => 25
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 6,
                'opening_time' => '09:00:00',
                'closing_time' => '23:00:00',
                'unavailable_hours' => json_encode(['15:00', '16:00']),
                'hourly_capacity' => json_encode([
                    '09:00' => 20,
                    '10:00' => 20,
                    '17:00' => 15,
                    '20:00' => 30
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 7,
                'opening_time' => '10:00:00',
                'closing_time' => '22:00:00',
                'unavailable_hours' => json_encode(['14:00']),
                'hourly_capacity' => json_encode([
                    '10:00' => 25,
                    '11:00' => 25,
                    '19:00' => 20,
                    '21:00' => 35
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 8,
                'opening_time' => '12:00:00',
                'closing_time' => '20:00:00',
                'unavailable_hours' => json_encode(['15:30', '16:30']),
                'hourly_capacity' => json_encode([
                    '12:00' => 10,
                    '13:00' => 15,
                    '17:00' => 25,
                    '19:00' => 20
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 9,
                'opening_time' => '11:00:00',
                'closing_time' => '21:00:00',
                'unavailable_hours' => json_encode([]),
                'hourly_capacity' => json_encode([
                    '11:00' => 30,
                    '13:00' => 30,
                    '18:00' => 40
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 10,
                'opening_time' => '08:00:00',
                'closing_time' => '20:00:00',
                'unavailable_hours' => json_encode(['12:00', '15:00']),
                'hourly_capacity' => json_encode([
                    '08:00' => 15,
                    '09:00' => 20,
                    '10:00' => 20,
                    '16:00' => 25
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 11,
                'opening_time' => '09:00:00',
                'closing_time' => '23:00:00',
                'unavailable_hours' => json_encode(['15:00', '16:00']),
                'hourly_capacity' => json_encode([
                    '09:00' => 20,
                    '10:00' => 20,
                    '17:00' => 15,
                    '20:00' => 30
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 12,
                'opening_time' => '10:00:00',
                'closing_time' => '22:00:00',
                'unavailable_hours' => json_encode(['14:00']),
                'hourly_capacity' => json_encode([
                    '10:00' => 25,
                    '11:00' => 25,
                    '19:00' => 20,
                    '21:00' => 35
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 13,
                'opening_time' => '12:00:00',
                'closing_time' => '20:00:00',
                'unavailable_hours' => json_encode(['15:30', '16:30']),
                'hourly_capacity' => json_encode([
                    '12:00' => 10,
                    '13:00' => 15,
                    '17:00' => 25,
                    '19:00' => 20
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 14,
                'opening_time' => '11:00:00',
                'closing_time' => '21:00:00',
                'unavailable_hours' => json_encode([]),
                'hourly_capacity' => json_encode([
                    '11:00' => 30,
                    '13:00' => 30,
                    '18:00' => 40
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 15,
                'opening_time' => '08:00:00',
                'closing_time' => '20:00:00',
                'unavailable_hours' => json_encode(['12:00', '15:00']),
                'hourly_capacity' => json_encode([
                    '08:00' => 15,
                    '09:00' => 20,
                    '10:00' => 20,
                    '16:00' => 25
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 16,
                'opening_time' => '09:00:00',
                'closing_time' => '23:00:00',
                'unavailable_hours' => json_encode(['15:00', '16:00']),
                'hourly_capacity' => json_encode([
                    '09:00' => 20,
                    '10:00' => 20,
                    '17:00' => 15,
                    '20:00' => 30
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 17,
                'opening_time' => '10:00:00',
                'closing_time' => '22:00:00',
                'unavailable_hours' => json_encode(['14:00']),
                'hourly_capacity' => json_encode([
                    '10:00' => 25,
                    '11:00' => 25,
                    '19:00' => 20,
                    '21:00' => 35
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 18,
                'opening_time' => '12:00:00',
                'closing_time' => '20:00:00',
                'unavailable_hours' => json_encode(['15:30', '16:30']),
                'hourly_capacity' => json_encode([
                    '12:00' => 10,
                    '13:00' => 15,
                    '17:00' => 25,
                    '19:00' => 20
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 19,
                'opening_time' => '11:00:00',
                'closing_time' => '21:00:00',
                'unavailable_hours' => json_encode([]),
                'hourly_capacity' => json_encode([
                    '11:00' => 30,
                    '13:00' => 30,
                    '18:00' => 40
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 20,
                'opening_time' => '08:00:00',
                'closing_time' => '20:00:00',
                'unavailable_hours' => json_encode(['12:00', '15:00']),
                'hourly_capacity' => json_encode([
                    '08:00' => 15,
                    '09:00' => 20,
                    '10:00' => 20,
                    '16:00' => 25
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 21,
                'opening_time' => '08:00:00',
                'closing_time' => '20:00:00',
                'unavailable_hours' => json_encode(['12:00', '15:00']),
                'hourly_capacity' => json_encode([
                    '08:00' => 15,
                    '09:00' => 20,
                    '10:00' => 20,
                    '16:00' => 25
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}