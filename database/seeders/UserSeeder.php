<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a new user
        $users = [
            [
            'uuid' => Str::uuid(),
            'name' => 'DSI',
            'email' => 'dsi@yakoafricassur.com',
            'fonction' => 'Directeur de Système d\'Information',
            'type' => 'superadmin',
            'password' => bcrypt('123456'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }

    }
}

