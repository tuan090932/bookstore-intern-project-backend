<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publishers = [
            'Nhà xuất bản Trẻ',
            'Nhà xuất bản Kim Đồng',
            'Nhà xuất bản Giáo dục Việt Nam',
            'Nhà xuất bản Văn học',
            'Nhà xuất bản Hội Nhà văn',
            'Nhà xuất bản Phụ nữ',
            'Nhà xuất bản Lao động',
            'Nhà xuất bản Chính trị Quốc gia Sự thật',
            'Nhà xuất bản Thế giới',
            'Nhà xuất bản Tổng hợp TP.HCM'
        ];

        foreach ($publishers as $publisherName) {
            $publisher = new Publisher();
            $publisher->publisher_name = $publisherName;
            $publisher->save();
        }
    }
}
