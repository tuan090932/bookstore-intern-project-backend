<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookOrders = [
            [
                'user_id' => 1,
                'order_date' => '2024-06-20',
                'status_id' => 1,
                'total_price' => 150000,
                'address_id' => 1,
                'order_address' => '123 Nguyễn Trãi, Thanh Xuân, Hanoi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'order_date' => '2024-06-21',
                'status_id' => 2,
                'total_price' => 200000,
                'address_id' => 2,
                'order_address' => '456 Lê Lợi, Quận 1, Ho Chi Minh City',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'order_date' => '2024-06-22',
                'status_id' => 3,
                'total_price' => 180000,
                'address_id' => 3,
                'order_address' => '789 Trần Phú, Hải Châu, Da Nang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'order_date' => '2024-06-24',
                'status_id' => 1,
                'total_price' => 250000,
                'address_id' => 5,
                'order_address' => '202 Lê Hồng Phong, Ngô Quyền, Hai Phong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6,
                'order_date' => '2024-06-25',
                'status_id' => 2,
                'total_price' => 300000,
                'address_id' => 6,
                'order_address' => '303 Hùng Vương, Phú Nhuận, Hue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'order_date' => '2024-06-26',
                'status_id' => 3,
                'total_price' => 350000,
                'address_id' => 7,
                'order_address' => '404 Trần Phú, Lộc Thọ, Nha Trang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('book_order')->insert($bookOrders);
    }
}
