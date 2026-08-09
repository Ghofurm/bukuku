<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeder extends Seeder
{
    /**
     * Jalankan seeder untuk mengisi data user secara hardcode.
     * Terdiri dari 1 admin dan 8 user biasa dengan password yang terdefinisi jelas.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Admin Bukuku',   'email' => 'admin@bukuku.test', 'password' => Hash::make('password'),  'role' => 'admin'],
            ['name' => 'Budi Santoso',   'email' => 'budi@test.com',     'password' => Hash::make('budi123'),   'role' => 'user'],
            ['name' => 'Siti Rahayu',    'email' => 'siti@test.com',     'password' => Hash::make('siti123'),   'role' => 'user'],
            ['name' => 'Ahmad Fauzi',    'email' => 'ahmad@test.com',    'password' => Hash::make('ahmad123'),  'role' => 'user'],
            ['name' => 'Dewi Lestari',   'email' => 'dewi@test.com',     'password' => Hash::make('dewi123'),   'role' => 'user'],
            ['name' => 'Rizky Pratama',  'email' => 'rizky@test.com',    'password' => Hash::make('rizky123'),  'role' => 'user'],
            ['name' => 'Nurul Hidayah',  'email' => 'nurul@test.com',    'password' => Hash::make('nurul123'),  'role' => 'user'],
            ['name' => 'Fajar Wijaya',   'email' => 'fajar@test.com',    'password' => Hash::make('fajar123'),  'role' => 'user'],
            ['name' => 'Rina Anggraini', 'email' => 'rina@test.com',     'password' => Hash::make('rina123'),   'role' => 'user'],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
