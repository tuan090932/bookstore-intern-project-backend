<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookOrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookOrderDetails = [
            [
                'order_id' => 1,
                'book_id' => 1,
                'quantity' => 2,
                'price' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 1,
                'book_id' => 2,
                'quantity' => 1,
                'price' => 50000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'book_id' => 3,
                'quantity' => 3,
                'price' => 60000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 3, 
                'book_id' => 4, 
                'quantity' => 2, 
                'price' => 70000, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 4, 
                'book_id' => 5, 
                'quantity' => 1,
                'price' => 80000, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 5,
                'book_id' => 9,
                'quantity' => 2,
                'price' => 130000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 5,
                'book_id' => 10,
                'quantity' => 1,
                'price' => 140000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 6,
                'book_id' => 2,
                'quantity' => 3,
                'price' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 6,
                'book_id' => 3,
                'quantity' => 2,
                'price' => 160000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('book_order_details')->insert($bookOrderDetails);
    }
}
