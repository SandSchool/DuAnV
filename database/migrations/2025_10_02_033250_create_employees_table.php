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
        Schema::create('employees', function (Blueprint $table) {
            $table->string("MANV", 20)->nullable(false)->primary();
            $table->string("MATKHAU", 80)->nullable(false);
            $table->string("EMAIL", 100)->nullable(false)->unique();
            $table->string("HOTEN", 40)->nullable(false);
            $table->string("SODT", 20)->nullable(false);
            $table->timestamp("NGVL")->useCurrent();
            $table->integer("NHOM")->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
