<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_reviews_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('MASP'); // Khóa ngoại đến products
            $table->integer('user_id')->nullable();
            $table->string('customer_name'); // Tên khách hàng
            $table->string('email')->nullable();
            $table->tinyInteger('rating'); // 1-5 sao
            $table->text('comment')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('MASP')->references('MASP')->on('products');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}