<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['category_name' => 'Văn học', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Lịch sử', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Khoa học', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
