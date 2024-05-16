<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'role' => 'user',
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make("password"),
        ]);

        User::factory()->create([
            'role' => 'admin',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make("password"),
        ]);
    }
}
