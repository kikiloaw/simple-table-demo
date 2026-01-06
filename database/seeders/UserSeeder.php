<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure a predictable test user exists
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Demo User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Seed random users for the user select demo
        User::factory(50)->create();
    }
}
