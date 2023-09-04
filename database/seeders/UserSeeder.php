<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "name" => "Riski Dafa",
                "username" => "rskdafa",
                "email" => "rskdafa@gmail.com",
                "phone_number" => "081234567890",
                "password" => "rahasia123",
                "role" => "admin"
            ],
            [
                "name" => "User Riski",
                "username" => "user88",
                "email" => "user@gmail.com",
                "phone_number" => "081234567855",
                "password" => "rahasia123",
                "role" => "user"
            ],
        ];

        foreach ($data as $user) {
            User::create($user);
        }
    }
}
