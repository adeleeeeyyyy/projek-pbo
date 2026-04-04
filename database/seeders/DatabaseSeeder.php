<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::firstOrCreate(
            ['email' => 'admin@beauty.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Customer User
        User::firstOrCreate(
            ['email' => 'user@beauty.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );

        $this->call([
            ProductSeeder::class,
        ]);
    }
}
