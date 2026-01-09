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
        $userData = [[
            'name' => 'User One',
            'email' => 'userone@example.com',
            'role' => 'user',
            'password' => bcrypt('123456789'),
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'name' => 'User Two',
            'email' => 'usertwo@example.com',
            'role' => 'user',
            'password' => bcrypt('123456789'),
            'created_at' => now(),
            'updated_at' => now(),
        ]
        ];
        foreach ($userData as $data) {
            User::create($data);
        }
    }
}
