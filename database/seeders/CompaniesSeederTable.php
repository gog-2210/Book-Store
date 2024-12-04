<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lorem = "What is Lorem Ipsum?Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.";
        DB::table('companies')->insert(
            [

                [
                    'company_name' => 'First News - Trí Việt',
                    'company_info' => 'Công ty phát hành sách: First News - Trí Việt' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'Công ty Văn hóa Hương Trang',
                    'company_info' => 'Công ty phát hành sách: Công ty Văn hóa Hương Trang' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'Skybooks',
                    'company_info' => 'Công ty phát hành sách: Skybooks' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'Người Trẻ Việt',
                    'company_info' => 'Công ty phát hành sách: Người Trẻ Việt' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'Quảng Văn',
                    'company_info' => 'Công ty phát hành sách: Quảng Văn' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'NXB Trẻ',
                    'company_info' => 'Công ty phát hành sách: NXB Trẻ' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'Limbooks',
                    'company_info' => 'Công ty phát hành sách: Limbooks' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'Đinh Tị',
                    'company_info' => 'Công ty phát hành sách: Đinh Tị' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'Alphabooks',
                    'company_info' => 'Công ty phát hành sách: Alphabooks' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'DT Books',
                    'company_info' => 'Công ty phát hành sách: DT Books' . $lorem,
                    'company_image' => null
                ],
                [
                    'company_name' => 'NXB Tổng Hợp',
                    'company_info' => 'Công ty phát hành sách: NXB Tổng Hợp' . $lorem,
                    'company_image' => null
                ]
            ]
        );
    }
}
