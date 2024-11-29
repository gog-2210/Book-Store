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
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('12345678'),
                    'email_verified_at' => new DateTime(),
                    'phone' => '0799999999',
                    'address' => 'Bạch Đằng, Đà Nẵng',
                    'role' => 1,
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
                        'password' => bcrypt('12345678'),
                        'email_verified_at' => new DateTime(),
                        'phone' => '037777111',
                        'address' => 'Địa chỉ nhà số ' . $i . ' Cao Thắng, ĐN',
                        'role' => 0,
                    ]
                ]
            );
        }
    }
}
