<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin Dinas Pendidikan',
            'email' => 'admin@dinpendidikan.go.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create additional test users
        User::create([
            'name' => 'Operator Buku Tamu',
            'email' => 'operator@dinpendidikan.go.id',
            'password' => Hash::make('operator123'),
            'role' => 'admin',
        ]);
    }
}
