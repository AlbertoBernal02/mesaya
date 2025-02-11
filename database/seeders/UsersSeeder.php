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
                'email' => 'cliente@mesaya.com',
                'password' => Hash::make('cliente123'),
                'role' => 'user', // ✅ Debe estar aquí
                
            ]
        ]);
    }
}
