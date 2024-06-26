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
                'city' => 'Hà Nội',
                'country_name' => 'Việt Nam',
                'shipping_address' => '123 Nguyễn Trãi, Thanh Xuân',
            ],
            [
                'user_id' => 2,
                'city' => 'Thành phố Hồ Chí Minh',
                'country_name' => 'Việt Nam',
                'shipping_address' => '456 Lê Lợi, Quận 1',
            ],
            [
                'user_id' => 3,
                'city' => 'Đà Nẵng',
                'country_name' => 'Việt Nam',
                'shipping_address' => '789 Trần Phú, Hải Châu',
            ],
            [
                'user_id' => 4,
                'city' => 'Cần Thơ',
                'country_name' => 'Việt Nam',
                'shipping_address' => '101 Nguyễn Văn Cừ, Ninh Kiều',
            ],
            [
                'user_id' => 5,
                'city' => 'Hải Phòng',
                'country_name' => 'Việt Nam',
                'shipping_address' => '202 Lê Hồng Phong, Ngô Quyền',
            ],
            [
                'user_id' => 6,
                'city' => 'Huế',
                'country_name' => 'Việt Nam',
                'shipping_address' => '303 Hùng Vương, Phú Nhuận',
            ],
            [
                'user_id' => 7,
                'city' => 'Nha Trang',
                'country_name' => 'Việt Nam',
                'shipping_address' => '404 Trần Phú, Lộc Thọ',
            ],
            [
                'user_id' => 8,
                'city' => 'Vũng Tàu',
                'country_name' => 'Việt Nam',
                'shipping_address' => '505 Lê Hồng Phong, Thắng Tam',
            ],
            [
                'user_id' => 9,
                'city' => 'Quy Nhơn',
                'country_name' => 'Việt Nam',
                'shipping_address' => '606 Nguyễn Tất Thành, Lê Hồng Phong',
            ],
            [
                'user_id' => 10,
                'city' => 'Phan Thiết',
                'country_name' => 'Việt Nam',
                'shipping_address' => '707 Trần Hưng Đạo, Phú Thủy',
            ],
            [
                'user_id' => 11,
                'city' => 'Biên Hòa',
                'country_name' => 'Việt Nam',
                'shipping_address' => '808 Phạm Văn Thuận, Tân Mai',
            ],
            [
                'user_id' => 12,
                'city' => 'Buôn Ma Thuột',
                'country_name' => 'Việt Nam',
                'shipping_address' => '909 Lê Duẩn, Tân Lợi',
            ],
            [
                'user_id' => 13,
                'city' => 'Pleiku',
                'country_name' => 'Việt Nam',
                'shipping_address' => '1010 Hùng Vương, Hoa Lư',
            ],
            [
                'user_id' => 14,
                'city' => 'Rạch Giá',
                'country_name' => 'Việt Nam',
                'shipping_address' => '1111 Nguyễn Trung Trực, Vĩnh Thanh',
            ],
            [
                'user_id' => 15,
                'city' => 'Long Xuyên',
                'country_name' => 'Việt Nam',
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
