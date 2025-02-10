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
                'role_id' => 1, // ID del rol de Administrador en la tabla roles
            ],
            [
                'name' => 'AdminPrueba MesaYa',
                'email' => 'adminprueba@mesaya.com',
                'password' => Hash::make('adminprueba'),
                'role_id' => 1, // ID del rol de Administrador en la tabla roles
            ],
            [
                'name' => 'Cliente Ejemplo',
                'email' => 'cliente@mesaya.com',
                'password' => Hash::make('cliente123'),
                'role_id' => 2, // ID del rol Cliente
            ]
        ]);
    }
}
