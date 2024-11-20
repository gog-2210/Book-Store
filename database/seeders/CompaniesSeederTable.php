<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lorem = " <h2>What is Lorem Ipsum?</h2><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>";
        DB::table('companies')->insert(
            [

                [
                    'company_name' => 'First News - Trí Việt',
                    'company_info' => 'Công ty phát hành sách: <b>First News - Trí Việt</b>' . $lorem,
                    'company_image' => '/storage/app/company-image/fn.jpg'

                ],
                [
                    'company_name' => 'Công ty Văn hóa Hương Trang',
                    'company_info' => 'Công ty phát hành sách: <b>Công ty Văn hóa Hương Trang</b>' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'Skybooks',
                    'company_info' => 'Công ty phát hành sách: <b>Skybooks</b>' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'Người Trẻ Việt',
                    'company_info' => 'Công ty phát hành sách: <b>Người Trẻ Việt</b>' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'Quảng Văn',
                    'company_info' => 'Công ty phát hành sách: <b>Quảng Văn</b>' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'NXB Trẻ',
                    'company_info' => 'Công ty phát hành sách: <b>NXB Trẻ</b>' . $lorem,
                    'company_image' => '/storage/app/company-image/tre.png'
                ],
                [
                    'company_name' => 'Limbooks',
                    'company_info' => 'Công ty phát hành sách: <b>Limbooks</b>' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'Đinh Tị',
                    'company_info' => 'Công ty phát hành sách: <b>Đinh Tị</b>' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'Alphabooks',
                    'company_info' => 'Công ty phát hành sách: <b>Alphabooks</b>' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'DT Books',
                    'company_info' => 'Công ty phát hành sách: <b>DT Books</b>' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'NXB Tổng Hợp',
                    'company_info' => 'Công ty phát hành sách: <b>NXB Tổng Hợp</b>' . $lorem,
                    'company_image' => null
                ]
            ]
        );
    }
}
