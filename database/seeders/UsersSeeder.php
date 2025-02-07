<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin MesaYa',
                'email' => 'admin@mesaya.com',
                'password' => Hash::make('admin123'),
                'role_id' => 1,
                'email_verified_at' => now(),
                'remember_token' => 'admin_token'
            ],
            [
                'name' => 'Restaurante La Parrilla',
                'email' => 'laparrilla@mesaya.com',
                'password' => Hash::make('restaurante123'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'remember_token' => 'restaurant_token'
            ],
            [
                'name' => 'Cliente Juan Pérez',
                'email' => 'juan.perez@mesaya.com',
                'password' => Hash::make('cliente123'),
                'role_id' => 3,
                'email_verified_at' => now(),
                'remember_token' => 'cliente_token'
            ],
        ]);
    }
}
