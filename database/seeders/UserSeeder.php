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
            ],
            [
                'user_name' => 'user7',
                'email' => 'user7@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987654323',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user8',
                'email' => 'user8@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0998877664',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user9',
                'email' => 'user9@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987123458',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user10',
                'email' => 'user10@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987654324',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user11',
                'email' => 'user11@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0998877665',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user12',
                'email' => 'user12@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987123459',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user13',
                'email' => 'user13@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987654325',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user14',
                'email' => 'user14@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0998877666',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user15',
                'email' => 'user15@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987123460',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user16',
                'email' => 'user16@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987654326',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user17',
                'email' => 'user17@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0998877667',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user18',
                'email' => 'user18@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987123461',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user19',
                'email' => 'user19@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987654327',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user20',
                'email' => 'user20@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0998877668',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user21',
                'email' => 'user21@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987123462',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user22',
                'email' => 'user22@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0987654328',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user23',
                'email' => 'user23@gmail.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0998877669',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'user24',
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
