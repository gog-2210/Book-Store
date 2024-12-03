<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('payment_id')->nullable()->constrained('payments');
            $table->string('order_status')->default('Đang xử lý đơn hàng');
            $table->string('shipping_address')->nullable();
            $table->string('phoneReceiver')->nullable();
            $table->string('nameReceiver')->nullable();
            $table->integer('shipping_fee')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
