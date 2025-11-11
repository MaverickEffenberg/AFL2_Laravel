<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('users')->insert([
            [
                'name' => 'admin',
                'password' => Hash::make('password123'),
                'email'=> 'admin@gmail.com',
                'role' => 'admin',
            ],
            [
                'name' => 'user',
                'password' => Hash::make('password123'),
                'email'=> 'user@gmail.com',
                'role' => 'user',
            ],
        ]);
    }
}
