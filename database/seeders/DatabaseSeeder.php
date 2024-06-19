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
        User::factory()->create([
            'name' => 'Mr Admin',
            'email' => 'admin@admin.com',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@user.com',
        ]);

        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'user2@user.com',
        ]);

        User::factory()->create([
            'name' => 'Test User 3',
            'email' => 'user3@user.com',
        ]);

        User::factory()->create([
            'name' => 'Test User 4',
            'email' => 'user4@user.com',
        ]);

        User::factory()->create([
            'name' => 'Test User 5',
            'email' => 'user5@user.com',
        ]);

        User::factory()->create([
            'name' => 'Test User 6',
            'email' => 'user6@user.com',
        ]);
    }
}
