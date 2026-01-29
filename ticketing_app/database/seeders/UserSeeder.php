<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}