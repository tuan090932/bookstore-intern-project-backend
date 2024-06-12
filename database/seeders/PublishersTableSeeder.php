<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublishersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('publishers')->insert([
            ['publisher_name' => 'NXB Trẻ'],
            ['publisher_name' => 'NXB Kim Đồng'],
        ]);
    }
}
