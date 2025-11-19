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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id(); // khoa chinh
            $table->integer("SOHD");
            $table->foreign("SOHD")->references("SOHD")->on("orders");
            $table->string("MASP", 20)->nullable(false);
            $table->foreign("MASP")->references("MASP")->on("products");
            $table->integer("SL")->unsigned();
            $table->integer("GIAGOC")->unsigned();
            $table->integer("GIABAN")->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
