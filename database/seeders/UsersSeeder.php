<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Restaurant1',
                'email' => 'restaurant1@mesaya.com',
                'password' => Hash::make('restaurant1'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant2',
                'email' => 'restaurant@mesaya.com2',
                'password' => Hash::make('restaurant2'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant3',
                'email' => 'restaurant3@mesaya.com',
                'password' => Hash::make('restaurant3'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant4',
                'email' => 'restaurant4@mesaya.com',
                'password' => Hash::make('restaurant4'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant5',
                'email' => 'restaurant5@mesaya.com',
                'password' => Hash::make('restaurant5'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant6',
                'email' => 'restaurant6@mesaya.com',
                'password' => Hash::make('restaurant6'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant7',
                'email' => 'restaurant7@mesaya.com',
                'password' => Hash::make('restaurant7'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant8',
                'email' => 'restaurant8@mesaya.com',
                'password' => Hash::make('restaurant8'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant9',
                'email' => 'restaurant9@mesaya.com',
                'password' => Hash::make('restaurant9'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant10',
                'email' => 'restaurant10@mesaya.com',
                'password' => Hash::make('restaurant10'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant11',
                'email' => 'restaurant11@mesaya.com',
                'password' => Hash::make('restaurant11'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant12',
                'email' => 'restaurant12@mesaya.com',
                'password' => Hash::make('restaurant12'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant13',
                'email' => 'restaurant13@mesaya.com',
                'password' => Hash::make('restaurant13'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant14',
                'email' => 'restaurant14@mesaya.com',
                'password' => Hash::make('restaurant14'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant15',
                'email' => 'restaurant15@mesaya.com',
                'password' => Hash::make('restaurant15'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant16',
                'email' => 'restaurant16@mesaya.com',
                'password' => Hash::make('restaurant16'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant17',
                'email' => 'restaurant17@mesaya.com',
                'password' => Hash::make('restaurant17'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant18',
                'email' => 'restaurant18@mesaya.com',
                'password' => Hash::make('restaurant18'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant19',
                'email' => 'restaurant19@mesaya.com',
                'password' => Hash::make('restaurant19'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant20',
                'email' => 'restaurant20@mesaya.com',
                'password' => Hash::make('restaurant20'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Restaurant21',
                'email' => 'restaurant21@mesaya.com',
                'password' => Hash::make('restaurant21'),
                'role' => 'restaurant', 
            ],
            [
                'name' => 'Admin MesaYa',
                'email' => 'admin@mesaya.com',
                'password' => Hash::make('admin'),
                'role' => 'admin', // ✅ Debe estar aquí
            ],
            [
                'name' => 'AdminPrueba MesaYa',
                'email' => 'adminprueba@mesaya.com',
                'password' => Hash::make('adminprueba'),
                'role' => 'admin', // ✅ Debe estar aquí
                
            ],
            [
                'name' => 'Cliente Ejemplo',
                'email' => 'abernalmejias@alumnos.ilerna.com',
                'password' => Hash::make('vertico'),
                'role' => 'user', // ✅ Debe estar aquí
                
            ]
        ]);
    }
}
