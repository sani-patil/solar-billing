<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 🚨 Permanent Solar Planet Admin Account
        User::updateOrCreate(
            ['email' => 'client@solar.com'],
            [
                'name' => 'Solar Planet Admin',
                'password' => Hash::make('password123'),
            ]
        );
    }
}