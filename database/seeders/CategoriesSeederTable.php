<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert(
            [
                [
                    'category_name' => 'Sách Tiếng Việt ',
                    'parent_id' => 0,
                    'order' => 1
                ],
                [
                    'category_name' => ' Sách Tiếng Anh',
                    'parent_id' => 0,
                    'order' => 2
                ],
                [
                    'category_name' => ' Sách Văn Học',
                    'parent_id' => 1,
                    'order' => 1
                ],
                [
                    'category_name' => 'Sách Thiếu Nhi ',
                    'parent_id' => 1,
                    'order' => 2
                ],
                [
                    'category_name' => 'Sách Kỹ Năng - Sống Đẹp',
                    'parent_id' => 1,
                    'order' => 3
                ],
                [
                    'category_name' => 'Sách Kinh Tế',
                    'parent_id' => 1,
                    'order' => 4
                ],
                [
                    'category_name' => 'Sách Nuôi Dạy Con',
                    'parent_id' => 1,
                    'order' => 5
                ],
                [
                    'category_name' => 'Sách Tham Khảo',
                    'parent_id' => 1,
                    'order' => 6
                ],
                [
                    'category_name' => 'Sách Giáo Khoa',
                    'parent_id' => 1,
                    'order' => 7
                ],
                [
                    'category_name' => 'Sách Học Ngoại Ngữ',
                    'parent_id' => 1,
                    'order' => 8
                ],
                [
                    'category_name' => 'Từ Điển',
                    'parent_id' => 1,
                    'order' => 9
                ],
                [
                    'category_name' => 'Truyện Tranh, Manga, Comic',
                    'parent_id' => 1,
                    'order' => 10
                ],
                [
                    'category_name' => 'Giáo Trình Đại Học - Cao Đẳng',
                    'parent_id' => 1,
                    'order' => 11
                ],
                [
                    'category_name' => 'Sách Kiến Thức Tổng Hợp',
                    'parent_id' => 1,
                    'order' => 12
                ],
                [
                    'category_name' => 'Sách Khoa Học - Kỹ Thuật',
                    'parent_id' => 1,
                    'order' => 13
                ]
            ]
        );
    }
}
