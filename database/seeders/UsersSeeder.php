<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TODO: make this an admin user
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'hamuda@email.com',
            'password' => Hash::make('Ch£c7Th!s0ut'),
        ]);

        // \App\Models\User::factory(10)->create();

        // User::create([]);
    }
}
