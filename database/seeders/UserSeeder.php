<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->user_name = 'user4';
        $user->email = 'user4@gmail.com';
        $user->password = Hash::make('123456');
        $user->phone_number = '0123456789';
        $user->save();
    }
}
