<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Dế Mèn Phiêu Lưu Ký',
                'language_id' => 1,
                'num_pages' => 200,
                'publisher_id' => 1,
                'category_id' => 1,
                'image' => 'https://example.com/de-men-phieu-luu-ky.jpg',
                'description' => 'A classic Vietnamese children\'s book.',
                'price' => 50000,
                'stock' => 100,
                'author_id' => 1,
            ],
            [
                'title' => 'Tắt Đèn',
                'language_id' => 1,
                'num_pages' => 150,
                'publisher_id' => 2,
                'category_id' => 2,
                'image' => 'https://example.com/tat-den.jpg',
                'description' => 'A novel about the plight of Vietnamese peasants.',
                'price' => 60000,
                'stock' => 80,
                'author_id' => 2,
            ],
            [
                'title' => 'Số Đỏ',
                'language_id' => 1,
                'num_pages' => 180,
                'publisher_id' => 3,
                'category_id' => 3,
                'image' => 'https://example.com/so-do.jpg',
                'description' => 'A satirical novel about Vietnamese society.',
                'price' => 55000,
                'stock' => 90,
                'author_id' => 3,
            ],
            [
                'title' => 'Chí Phèo',
                'language_id' => 1,
                'num_pages' => 120,
                'publisher_id' => 4,
                'category_id' => 4,
                'image' => 'https://example.com/chi-pheo.jpg',
                'description' => 'A story about a tragic anti-hero in Vietnamese literature.',
                'price' => 45000,
                'stock' => 70,
                'author_id' => 4,
            ],
            [
                'title' => 'Lão Hạc',
                'language_id' => 1,
                'num_pages' => 130,
                'publisher_id' => 5,
                'category_id' => 5,
                'image' => 'https://example.com/lao-hac.jpg',
                'description' => 'A touching story about a poor old man and his dog.',
                'price' => 48000,
                'stock' => 60,
                'author_id' => 5,
            ],
            [
                'title' => 'Vợ Nhặt',
                'language_id' => 1,
                'num_pages' => 140,
                'publisher_id' => 6,
                'category_id' => 6,
                'image' => 'https://example.com/vo-nhat.jpg',
                'description' => 'A story about love and survival during famine.',
                'price' => 52000,
                'stock' => 75,
                'author_id' => 6,
            ],
            [
                'title' => 'Đất Rừng Phương Nam',
                'language_id' => 1,
                'num_pages' => 160,
                'publisher_id' => 7,
                'category_id' => 7,
                'image' => 'https://example.com/dat-rung-phuong-nam.jpg',
                'description' => 'A novel about the life and adventures in the southern forests.',
                'price' => 58000,
                'stock' => 85,
                'author_id' => 7,
            ],
            [
                'title' => 'Người Lái Đò Sông Đà',
                'language_id' => 1,
                'num_pages' => 170,
                'publisher_id' => 8,
                'category_id' => 8,
                'image' => 'https://example.com/nguoi-lai-do-song-da.jpg',
                'description' => 'A story about the bravery of a boatman on the Da River.',
                'price' => 54000,
                'stock' => 65,
                'author_id' => 8,
            ],
            [
                'title' => 'Mắt Biếc',
                'language_id' => 1,
                'num_pages' => 190,
                'publisher_id' => 9,
                'category_id' => 9,
                'image' => 'https://example.com/mat-biec.jpg',
                'description' => 'A touching love story that spans decades.',
                'price' => 62000,
                'stock' => 95,
                'author_id' => 9,
            ],
            [
                'title' => 'Nỗi Buồn Chiến Tranh',
                'language_id' => 1,
                'num_pages' => 210,
                'publisher_id' => 10,
                'category_id' => 10,
                'image' => 'https://example.com/noi-buon-chien-tranh.jpg',
                'description' => 'A poignant novel about the Vietnam War.',
                'price' => 65000,
                'stock' => 110,
                'author_id' => 10,
            ],
        ];

        foreach ($books as $bookData) {
            $book = new Book();
            $book->fill($bookData);
            $book->save();
        }
    }
}