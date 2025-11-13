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
        Schema::create('customers', function (Blueprint $table) {
            $table->string("MAKH", 20)->nullable(false)->primary();
            $table->string("EMAIL", 100)->nullable(false)->unique();
            $table->string("MATKHAU", 80)->nullable(false);
            $table->string("HOTEN", 40)->nullable(false);
            $table->string("DCHI", 50)->nullable(false);
            $table->string("SODT", 20)->nullable(false)->unique();
            $table->date("NGSINH");
            $table->timestamp("NGDK")->useCurrent();
            $table->integer("DOANHSO")->default(0)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
