<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addresses = [
            [
                'user_id' => 1,
                'city' => 'Hanoi',
                'country_name' => 'Vietnam',
                'shipping_address' => '123 Nguyễn Trãi, Thanh Xuân',
            ],
            [
                'user_id' => 2,
                'city' => 'Ho Chi Minh City',
                'country_name' => 'Vietnam',
                'shipping_address' => '456 Lê Lợi, Quận 1',
            ],
            [
                'user_id' => 3,
                'city' => 'Da Nang',
                'country_name' => 'Vietnam',
                'shipping_address' => '789 Trần Phú, Hải Châu',
            ],
            [
                'user_id' => 4,
                'city' => 'Can Tho',
                'country_name' => 'Vietnam',
                'shipping_address' => '101 Nguyễn Văn Cừ, Ninh Kiều',
            ],
            [
                'user_id' => 5,
                'city' => 'Hai Phong',
                'country_name' => 'Vietnam',
                'shipping_address' => '202 Lê Hồng Phong, Ngô Quyền',
            ],
            [
                'user_id' => 6,
                'city' => 'Hue',
                'country_name' => 'Vietnam',
                'shipping_address' => '303 Hùng Vương, Phú Nhuận',
            ],
            [
                'user_id' => 7,
                'city' => 'Nha Trang',
                'country_name' => 'Vietnam',
                'shipping_address' => '404 Trần Phú, Lộc Thọ',
            ],
            [
                'user_id' => 8,
                'city' => 'Vung Tau',
                'country_name' => 'Vietnam',
                'shipping_address' => '505 Lê Hồng Phong, Thắng Tam',
            ],
            [
                'user_id' => 9,
                'city' => 'Quy Nhon',
                'country_name' => 'Vietnam',
                'shipping_address' => '606 Nguyễn Tất Thành, Lê Hồng Phong',
            ],
            [
                'user_id' => 10,
                'city' => 'Phan Thiet',
                'country_name' => 'Vietnam',
                'shipping_address' => '707 Trần Hưng Đạo, Phú Thủy',
            ],
            [
                'user_id' => 11,
                'city' => 'Bien Hoa',
                'country_name' => 'Vietnam',
                'shipping_address' => '808 Phạm Văn Thuận, Tân Mai',
            ],
            [
                'user_id' => 12,
                'city' => 'Buon Ma Thuot',
                'country_name' => 'Vietnam',
                'shipping_address' => '909 Lê Duẩn, Tân Lợi',
            ],
            [
                'user_id' => 13,
                'city' => 'Pleiku',
                'country_name' => 'Vietnam',
                'shipping_address' => '1010 Hùng Vương, Hoa Lư',
            ],
            [
                'user_id' => 14,
                'city' => 'Rach Gia',
                'country_name' => 'Vietnam',
                'shipping_address' => '1111 Nguyễn Trung Trực, Vĩnh Thanh',
            ],
            [
                'user_id' => 15,
                'city' => 'Long Xuyen',
                'country_name' => 'Vietnam',
                'shipping_address' => '1212 Trần Hưng Đạo, Mỹ Bình',
            ],
        ];

        foreach ($addresses as $addressData) {
            $address = new Address();
            $address->fill($addressData);
            $address->save();
        }
    }
}
