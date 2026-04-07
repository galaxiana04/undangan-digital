<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Akun Admin (Mbak Riza)
        User::create([
            'name' => 'Riza Sukma (Admin)',
            'email' => 'admin@rizasukma.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Akun Vendor (Penjual Desain)
        User::create([
            'name' => 'Studio Kreatif (Vendor)',
            'email' => 'vendor@rizasukma.com',
            'password' => Hash::make('password123'),
            'role' => 'vendor',
        ]);

        // 3. Akun Customer (Catin)
        User::create([
            'name' => 'Romeo & Juliet (Catin)',
            'email' => 'catin@rizasukma.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
        ]);
    }
}