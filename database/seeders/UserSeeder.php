<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure related data exists before seeding users
        DB::table('address')->insert([
            ['city' => 'Ho Chi Minh', 'country_name' => 'Viet Nam', 'shipping_address' => 'Thu Duc', 'created_at' => now(), 'updated_at' => now()],
            ['city' => 'Ho Chi Minh', 'country_name' => 'Viet Nam', 'shipping_address' => 'Go Vap', 'created_at' => now(), 'updated_at' => now()],
            ['city' => 'Ho Chi Minh', 'country_name' => 'Viet Nam', 'shipping_address' => 'Quan 12', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Create user entries
        $users = [
            [
                'user_name' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987654321',
                'address_id' => 1,
            ],
            [
                'user_name' => 'user2',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0998877665',
                'address_id' => 2,
            ],
            [
                'user_name' => 'user3',
                'email' => 'user3@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987123456',
                'address_id' => 3,
            ],
        ];

        foreach ($users as $userData) {
            $user = new User();
            $user->fill($userData);
            $user->save();
        }

        // $user = new User();
        // $user->name = 'user1';
        // $user->email = 'user1@gmail.com';
        // $user->password = Hash::make('123456');
        // $user->phone_number = '0123456789';
        // $user->address_id = 1;
        // $user->save();
    }
}
