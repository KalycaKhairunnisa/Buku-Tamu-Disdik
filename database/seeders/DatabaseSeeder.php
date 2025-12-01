<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\GuestBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users first
        $this->call(UserSeeder::class);

        // Seed kecamatan data
        $this->call(KecamatanSeeder::class);

        // Create sample guest book data
        GuestBook::factory(15)->create();
    }
}
