<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table("employees")->insert([
            [
                'MANV' => "FSE00001", // FSE00001
                'MATKHAU' => bcrypt("12345678"),
                'EMAIL' => 'admin@ls.com',
                'HOTEN' => 'Admin',
                'SODT' => '0912345678',
//                'NGVL' => '2025-10-09', // Y-m-d
                'NHOM' => '1'
            ],
            [
                'MANV' => "FSE00002", // FSE00002
                'MATKHAU' => bcrypt("12345678"),
                'EMAIL' => 'maithaiquoc@ls.com',
                'HOTEN' => 'Mai Thai Quoc',
                'SODT' => '0812345678',
//                'NGVL' => '2025-10-09', // Y-m-d
                'NHOM' => '0'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
};
