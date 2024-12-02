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
                        'payment_status' => 'Chưa thanh toán',
                        'payment_type' => 'Thanh toán bằng thẻ ATM',
                        'amount' => 10000,
                        'remember_token' => bcrypt('hihi' . $i),
                        'created_at' => new DateTime(),
                        'updated_at' => new DateTime()
                    ]
                ]
            );
        }
    }
}
