<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('payments')->insert(
                [
                    [
                        'payment_status' => 'Đã thanh toán',
                        'payment_type' => 'Thanh toán qua thẻ',
                        'amount' => rand(100000, 1000000),
                        'created_at' => new DateTime(),
                        'updated_at' => new DateTime()
                    ]
                ]
            );
        }
    }
}
