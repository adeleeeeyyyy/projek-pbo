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
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@beauty.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Customer User
        User::create([
            'name' => 'Regular User',
            'email' => 'user@beauty.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);
    }
}
