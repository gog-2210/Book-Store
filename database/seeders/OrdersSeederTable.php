<?php

namespace Database\Seeders;

use DateTime;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('orders')->insert(
                [
                    [
                        'user_id' => rand(2, 10),
                        'payment_id' => $i,
                        'order_status' => 'Đang xử lý đơn hàng',
                        'shipping_address' => 'Nhà số ' . $i . ' Văn Tiến Dũng, HN City ^_^ ',
                        'phoneReceiver' => '09000' . rand(0, 10) . rand(0, 10) . rand(0, 10) . rand(0, 10) . rand(0, 10),
                        'nameReceiver' => 'Tên người nhận ' . $i,
                        'shipping_fee' => rand(0, 1) * 20000,
                        'created_at' => new DateTime(),
                        'updated_at' => new DateTime()
                    ]
                ]
            );
        }
    }
}
