<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Restaurant1',
                'email' => 'restaurant1@yopmail.com',
                'password' => Hash::make('restaurant1'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(), // ✅ Email verificado
            ],
            [
                'name' => 'Restaurant2',
                'email' => 'restaurant2@yopmail.com',
                'password' => Hash::make('restaurant2'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant3',
                'email' => 'restaurant3@yopmail.com',
                'password' => Hash::make('restaurant3'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant4',
                'email' => 'restaurant4@yopmail.com',
                'password' => Hash::make('restaurant4'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant5',
                'email' => 'restaurant5@yopmail.com',
                'password' => Hash::make('restaurant5'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant6',
                'email' => 'restaurant6@yopmail.com',
                'password' => Hash::make('restaurant6'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant7',
                'email' => 'restaurant7@yopmail.com',
                'password' => Hash::make('restaurant7'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant8',
                'email' => 'restaurant8@yopmail.com',
                'password' => Hash::make('restaurant8'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant9',
                'email' => 'restaurant9@yopmail.com',
                'password' => Hash::make('restaurant9'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant10',
                'email' => 'restaurant10@yopmail.com',
                'password' => Hash::make('restaurant10'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant11',
                'email' => 'restaurant11@yopmail.com',
                'password' => Hash::make('restaurant11'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant12',
                'email' => 'restaurant12@yopmail.com',
                'password' => Hash::make('restaurant12'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant13',
                'email' => 'restaurant13@yopmail.com',
                'password' => Hash::make('restaurant13'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant14',
                'email' => 'restaurant14@yopmail.com',
                'password' => Hash::make('restaurant14'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant15',
                'email' => 'restaurant15@yopmail.com',
                'password' => Hash::make('restaurant15'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant16',
                'email' => 'restaurant16@yopmail.com',
                'password' => Hash::make('restaurant16'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant17',
                'email' => 'restaurant17@yopmail.com',
                'password' => Hash::make('restaurant17'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant18',
                'email' => 'restaurant18@yopmail.com',
                'password' => Hash::make('restaurant18'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant19',
                'email' => 'restaurant19@yopmail.com',
                'password' => Hash::make('restaurant19'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant20',
                'email' => 'restaurant20@yopmail.com',
                'password' => Hash::make('restaurant20'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Restaurant21',
                'email' => 'restaurant21@yopmail.com',
                'password' => Hash::make('restaurant21'),
                'role' => 'restaurant',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Admin MesaYa',
                'email' => 'adminmesaya@yopmail.com',
                'password' => Hash::make('admin'),
                'role' => 'admin', // ✅ Debe estar aquí
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'AdminPrueba MesaYa',
                'email' => 'adminprueba@mesaya.com',
                'password' => Hash::make('adminprueba'),
                'role' => 'admin', // ✅ Debe estar aquí
                'email_verified_at' => Carbon::now(),

            ],
            [
                'name' => 'Cliente Ejemplo',
                'email' => 'abernalmejias@alumnos.ilerna.com',
                'password' => Hash::make('vertico'),
                'role' => 'user', // ✅ Debe estar aquí
                'email_verified_at' => Carbon::now(),

            ],
            [
                'name' => 'Jesus',
                'email' => 'jesuscasacarrillo@alumnos.ilerna.com',
                'password' => Hash::make('jesus'),
                'role' => 'user', // ✅ Debe estar aquí
                'email_verified_at' => Carbon::now(),

            ],
            [
                'name' => 'Jesus',
                'email' => 'jesuscasacarrillo@gmail.com',
                'password' => Hash::make('jesus'),
                'role' => 'user', // ✅ Debe estar aquí
                'email_verified_at' => Carbon::now(),

            ]
        ]);
    }
}