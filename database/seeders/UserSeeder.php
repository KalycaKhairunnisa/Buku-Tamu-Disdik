<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create or update admin user
        User::updateOrCreate(
            ['email' => 'admin@dinpendidikan.go.id'],
            [
                'name' => 'Admin Dinas Pendidikan',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Create or update operator user
        User::updateOrCreate(
            ['email' => 'operator@dinpendidikan.go.id'],
            [
                'name' => 'Operator Buku Tamu',
                'password' => Hash::make('operator123'),
                'role' => 'admin',
            ]
        );
    }
}
