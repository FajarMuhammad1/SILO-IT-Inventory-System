<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat satu admin manual
        User::factory()->admin()->create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('Admin123!'),
        ]);

        // Buat beberapa staff acak
        User::factory(5)->staff()->create();
    }
}
