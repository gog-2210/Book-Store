<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderDetailsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 40; $i++) {
            DB::table('order_details')->insert(
                [
                    [
                        'order_id' => rand(1, 10),
                        'book_id' => rand(1, 16),
                        'price' => rand(1, 17) * 10000,
                        'quality' => rand(1, 10),
                    ]
                ]
            );
        }
    }
}
