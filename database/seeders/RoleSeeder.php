<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['role_id' => 'ALL', 'role_name' => 'All permissions'],
            ['role_id' => 'MG', 'role_name' => 'Manager'],
            ['role_id' => 'READ', 'role_name' => 'Read only'],
            ['role_id' => 'PUB', 'role_name' => 'Publishers'],
            ['role_id' => 'AUTHO', 'role_name' => 'Authors'],
            ['role_id' => 'BOOK', 'role_name' => 'Books'],
            ['role_id' => 'CAT', 'role_name' => 'Categories'],
            ['role_id' => 'ORD', 'role_name' => 'Orders'],
            ['role_id' => 'CUST', 'role_name' => 'Customers'],
        ];

        Role::insert($roles);
    }
}
