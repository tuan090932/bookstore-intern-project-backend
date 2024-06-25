<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'status_name' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status_name' => 'processing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status_name' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status_name' => 'cancel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('order_status')->insert($statuses);
    }
}
