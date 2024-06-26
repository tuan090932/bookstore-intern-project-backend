<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminUser::create([
            'admin_name' => 'Hồ Phú Tài',
            'password' => Hash::make('Tai@123'),
            'email' => 'admin@gmail.com',
            'role_id' => 'ALL',
        ]);
    }
}
