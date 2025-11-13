<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string("MASP", 20)->nullable(false)->primary();
            $table->string("TENSP", 40)->nullable(false)->unique();
            $table->string("HINHANH", 100)->nullable(false);
            $table->string("DVT", 20)->nullable(false);
            $table->string("NUOCSX", 40)->nullable(false);
            $table->integer("GIA")->nullable(false)->unsigned();
            $table->text("MOTA")->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
