<?php

namespace Database\Seeders;

use DateTime;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Adminstrator',
                    'email' => 'buihai2603@gmail.com',
                    'password' => bcrypt('123456'),
                    'phone' => 1664872279,
                    'address' => 'Từ liêm Hà nội',
                    'level' => 1,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime()

                ]
            ]
        );
        for ($i = 2; $i <= 12; $i++) {
            DB::table('users')->insert(
                [
                    [
                        'name' => 'Người dùng ' . $i,
                        'email' => 'member' . $i . '@gmail.com',
                        'password' => bcrypt('123456'),
                        'phone' => 1664872279,
                        'address' => 'Địa chỉ nhà số ' . $i . ' Văn Tiến Dũng, HN',
                        'level' => 0,
                        'created_at' => new DateTime(),
                        'updated_at' => new DateTime()

                    ]
                ]
            );
        }
    }
}
