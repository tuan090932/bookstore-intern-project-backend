<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Fiction',
            'Non-Fiction',
            'Science Fiction',
            'Fantasy',
            'Mystery',
            'Thriller',
            'Romance',
            'Horror',
            'Biography',
            'Self-Help',
            'History',
            'Children',
            'Adventure',
            'Graphic Novel',
            'Poetry',
            'Drama',
            'Classic',
            'Cookbook',
            'Travel',
            'True Crime',
            'Art',
        ];

        foreach ($categories as $categoryName) {
            $category = new Category();
            $category->category_name = $categoryName;
            $category->save();
        }
    }
}
