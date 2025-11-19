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
        Schema::create('orders', function (Blueprint $table) {
            $table->integer("SOHD")->autoIncrement();
            $table->timestamp("NGHD")->useCurrent();
            $table->string("MAKH", 20)->nullable(false);
            $table->foreign("MAKH")->references("MAKH")->on("customers");
            $table->string("MANV", 20)->nullable(false);
            $table->foreign("MANV")->references("MANV")->on("employees");
            $table->integer("TRIGIA")->unsigned();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
