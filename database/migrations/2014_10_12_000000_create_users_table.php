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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
            $table->bigInteger('phone')->nullable();
            $table->string('address')->nullable();
            $table->smallInteger('level')->default(0)->comment('0:customer, 1:admin');
            $table->boolean('block')->default(false)->comment('true:block');
            $table->boolean('deleted')->default(false)->comment('true:delete');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
