<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Check if user exists first to prevent duplicates on multiple runs
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Demo User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'), // Ensure password is known
            ]);
        }
    }
}
