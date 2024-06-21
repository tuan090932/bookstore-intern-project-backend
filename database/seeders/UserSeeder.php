<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                'name' => 'User Four',
                'email' => 'user4@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987654322',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user5',
                'name' => 'User Five',
                'email' => 'user5@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0998877663',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user6',
                'name' => 'User Six',
                'email' => 'user6@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987123457',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user7',
                'name' => 'User Seven',
                'email' => 'user7@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987654323',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user8',
                'name' => 'User Eight',
                'email' => 'user8@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0998877664',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user9',
                'name' => 'User Nine',
                'email' => 'user9@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987123458',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user10',
                'name' => 'User Ten',
                'email' => 'user10@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987654324',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user11',
                'name' => 'User Eleven',
                'email' => 'user11@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0998877665',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user12',
                'name' => 'User Twelve',
                'email' => 'user12@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987123459',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user13',
                'name' => 'User Thirteen',
                'email' => 'user13@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987654325',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user14',
                'name' => 'User Fourteen',
                'email' => 'user14@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0998877666',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user15',
                'name' => 'User Fifteen',
                'email' => 'user15@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987123460',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user16',
                'name' => 'User Sixteen',
                'email' => 'user16@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987654326',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user17',
                'name' => 'User Seventeen',
                'email' => 'user17@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0998877667',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user18',
                'name' => 'User Eighteen',
                'email' => 'user18@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987123461',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user19',
                'name' => 'User Nineteen',
                'email' => 'user19@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987654327',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user20',
                'name' => 'User Twenty',
                'email' => 'user20@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0998877668',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user21',
                'name' => 'User Twenty-One',
                'email' => 'user21@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987123462',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user22',
                'name' => 'User Twenty-Two',
                'email' => 'user22@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987654328',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user23',
                'name' => 'User Twenty-Three',
                'email' => 'user23@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0998877669',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user24',
                'name' => 'User Twenty-Four',
                'email' => 'user24@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987123463',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
