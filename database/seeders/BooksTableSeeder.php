<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'title' => 'Cho tôi xin một vé đi tuổi thơ',
                'language_id' => 1,
                'publisher_id' => 1,
                'category_id' => 1,
                'author_id' => 1,
                'num_pages' => 230,
                'image' => 'https://cdn0.fahasa.com/media/catalog/product/8/9/8935212361934.jpg',
                'description' => 'Một cuốn sách về tuổi thơ',
                'price' => 100000,
                'stock' => 50,
            ],
            [
                'title' => 'Tuổi thơ dữ dội',
                'language_id' => 1,
                'publisher_id' => 2,
                'category_id' => 1,
                'author_id' => 2,
                'num_pages' => 350,
                'image' => 'https://cdn0.fahasa.com/media/catalog/product/i/m/image_229833.jpg',
                'description' => 'Một cuốn sách về tuổi thơ thời chiến của Nguyễn Huy Thiệp.',
                'price' => 150000,
                'stock' => 30,
            ],
        ]);
    }
}
