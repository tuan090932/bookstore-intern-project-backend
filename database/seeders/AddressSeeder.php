<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure related data exists before seeding address
        $users = [
            [
                'user_name' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987654321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user2',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0998877665',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user3',
                'email' => 'user3@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987123456',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('users')->insert($users);

        // Create address entries
        $addresses = [
            ['city' => 'Ho Chi Minh', 'country_name' => 'Viet Nam', 'shipping_address' => 'Thu Duc', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['city' => 'Ho Chi Minh', 'country_name' => 'Viet Nam', 'shipping_address' => 'Go Vap', 'user_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['city' => 'Ho Chi Minh', 'country_name' => 'Viet Nam', 'shipping_address' => 'Quan 12', 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('addresses')->insert($addresses);
    }
}