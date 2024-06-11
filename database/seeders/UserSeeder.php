<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'user_name' => 'user4',
                'email' => 'user4@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987654322',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user5',
                'email' => 'user5@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0998877663',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user6',
                'email' => 'user6@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987123457',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('users')->insert($users);
    }
}
