<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            ['author_id' => 1, 'author_name' => 'Nguyễn Nhật Ánh', 'age' => 68, 'birth_date' => '1955-05-07', 'death_date' => null],
            ['author_id' => 2, 'author_name' => 'Nguyễn Huy Thiệp', 'age' => 71, 'birth_date' => '1950-04-29', 'death_date' => '2021-03-20'],
            ['author_id' => 3, 'author_name' => 'Tô Hoài', 'age' => 94, 'birth_date' => '1920-09-27', 'death_date' => '2014-07-06'],
            ['author_id' => 4, 'author_name' => 'Nam Cao', 'age' => 36, 'birth_date' => '1915-10-29', 'death_date' => '1951-11-30'],
            ['author_id' => 5, 'author_name' => 'Nguyễn Tuân', 'age' => 82, 'birth_date' => '1910-07-10', 'death_date' => '1987-07-28'],
            ['author_id' => 6, 'author_name' => 'Xuân Diệu', 'age' => 74, 'birth_date' => '1916-02-02', 'death_date' => '1985-12-18'],
            ['author_id' => 7, 'author_name' => 'Hàn Mặc Tử', 'age' => 28, 'birth_date' => '1912-09-22', 'death_date' => '1940-11-11'],
            ['author_id' => 8, 'author_name' => 'Chế Lan Viên', 'age' => 62, 'birth_date' => '1920-10-20', 'death_date' => '1989-06-24'],
            ['author_id' => 9, 'author_name' => 'Nguyễn Đình Thi', 'age' => 82, 'birth_date' => '1924-12-20', 'death_date' => '2003-04-18'],
            ['author_id' => 10, 'author_name' => 'Nguyễn Khải', 'age' => 77, 'birth_date' => '1930-12-03', 'death_date' => '2008-01-15'],
            ['author_id' => 11, 'author_name' => 'Nguyễn Minh Châu', 'age' => 56, 'birth_date' => '1930-10-20', 'death_date' => '1989-01-23'],
            ['author_id' => 12, 'author_name' => 'Nguyễn Ngọc Tư', 'age' => 47, 'birth_date' => '1976-11-20', 'death_date' => null],
            ['author_id' => 13, 'author_name' => 'Nguyễn Nhật Chiêu', 'age' => 65, 'birth_date' => '1958-03-15', 'death_date' => null],
            ['author_id' => 14, 'author_name' => 'Nguyễn Quang Sáng', 'age' => 82, 'birth_date' => '1932-01-12', 'death_date' => '2014-02-13'],
            ['author_id' => 15, 'author_name' => 'Nguyễn Trọng Tạo', 'age' => 72, 'birth_date' => '1947-08-25', 'death_date' => '2019-01-07'],
            ['author_id' => 16, 'author_name' => 'Nguyễn Xuân Khánh', 'age' => 88, 'birth_date' => '1933-10-15', 'death_date' => '2021-06-12'],
            ['author_id' => 17, 'author_name' => 'Nguyễn Văn Thọ', 'age' => 70, 'birth_date' => '1953-05-10', 'death_date' => null],
            ['author_id' => 18, 'author_name' => 'Nguyễn Huy Tưởng', 'age' => 48, 'birth_date' => '1912-05-06', 'death_date' => '1960-07-25'],
            ['author_id' => 19, 'author_name' => 'Nguyễn Bính', 'age' => 49, 'birth_date' => '1918-02-13', 'death_date' => '1966-01-20'],
            ['author_id' => 20, 'author_name' => 'Nguyễn Duy', 'age' => 75, 'birth_date' => '1948-08-10', 'death_date' => null],
            ['author_id' => 21, 'author_name' => 'Nguyễn Khoa Điềm', 'age' => 80, 'birth_date' => '1943-04-15', 'death_date' => null],
        ];

        foreach ($authors as $authorData) {
            $author = new Author();
            $author->fill($authorData);
            $author->save();
        }
    }
}
