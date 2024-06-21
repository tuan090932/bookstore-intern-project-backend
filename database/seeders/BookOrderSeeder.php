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
                'user_id' => 4,
                'order_date' => '2024-06-23',
                'status_id' => 4,
                'total_price' => 220000,
                'address_id' => 4,
                'order_address' => '101 Nguyễn Văn Cừ, Ninh Kiều, Can Tho',
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
            [
                'user_id' => 8,
                'order_date' => '2024-06-27',
                'status_id' => 4,
                'total_price' => 400000,
                'address_id' => 8,
                'order_address' => '505 Lê Hồng Phong, Thắng Tam, Vung Tau',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9,
                'order_date' => '2024-06-28',
                'status_id' => 1,
                'total_price' => 450000,
                'address_id' => 9,
                'order_address' => '606 Nguyễn Tất Thành, Lê Hồng Phong, Quy Nhon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 10,
                'order_date' => '2024-06-29',
                'status_id' => 2,
                'total_price' => 500000,
                'address_id' => 10,
                'order_address' => '707 Trần Hưng Đạo, Phú Thủy, Phan Thiet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 11,
                'order_date' => '2024-06-30',
                'status_id' => 3,
                'total_price' => 550000,
                'address_id' => 11,
                'order_address' => '808 Phạm Văn Thuận, Tân Mai, Bien Hoa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 12,
                'order_date' => '2024-07-01',
                'status_id' => 4,
                'total_price' => 600000,
                'address_id' => 12,
                'order_address' => '909 Lê Duẩn, Tân Lợi, Buon Ma Thuot',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 13,
                'order_date' => '2024-07-02',
                'status_id' => 1,
                'total_price' => 650000,
                'address_id' => 13,
                'order_address' => '1010 Hùng Vương, Hoa Lư, Pleiku',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 14,
                'order_date' => '2024-07-03',
                'status_id' => 2,
                'total_price' => 700000,
                'address_id' => 14,
                'order_address' => '1111 Nguyễn Trung Trực, Vĩnh Thanh, Rach Gia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 15,
                'order_date' => '2024-07-04',
                'status_id' => 3,
                'total_price' => 750000,
                'address_id' => 15,
                'order_address' => '1212 Trần Hưng Đạo, Mỹ Bình, Long Xuyen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('book_order')->insert($bookOrders);
    }
}
