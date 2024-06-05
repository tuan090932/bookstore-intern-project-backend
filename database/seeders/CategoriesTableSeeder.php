<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo một mảng các danh mục
        $categories = [
            ['category_name' => 'Sách Giáo Khoa'],
            ['category_name' => 'Sách Tham Khảo'],
            ['category_name' => 'Tiểu Thuyết']
        ];
        // Thêm các danh mục vào bảng 'categories'
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'category_name' => $category['category_name'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
