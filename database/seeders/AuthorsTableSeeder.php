<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('authors')->insert([
            ['author_name' => 'Nguyễn Nhật Ánh'],
            ['author_name' => 'Nguyễn Huy Thiệp'],
        ]);
    }
}
