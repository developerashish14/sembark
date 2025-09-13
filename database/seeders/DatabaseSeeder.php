<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => "SuperAdmin",
            'email' => "superadmin@gmail.com",
            'phone' => '7891531844',
            'password' => bcrypt("12345678"),
            'role' => 'superadmin'
        ]);
    }
}
