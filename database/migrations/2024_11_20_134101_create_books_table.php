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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_name');
            $table->text('description')->nullable();
            $table->date('publish_date')->nullable();
            $table->boolean('suggest')->nullable();
            $table->string('author')->nullable();
            $table->foreignId('company_id')->nullable()->constrained('companies');
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->string('publishing_house')->nullable();
            $table->string('translator')->nullable();
            $table->integer('number_of_pages')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('sold')->default(0);
            $table->bigInteger('price')->nullable();
            $table->bigInteger('cover_price')->nullable();
            $table->string('book_image')->nullable();
            $table->text('images')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
