<?php

namespace Database\Seeders;

use DateTime;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('carts')->insert(
                [
                    [
                        'user_id' => rand(1, 12),
                        'book_id' => rand(1, 16),
                        'quantity' => rand(1, 10),
                        'price' => rand(10, 100) * 1000,
                        'created_at' => new DateTime(),
                        'updated_at' => new DateTime()
                    ]
                ]
            );
        }
    }
}
