<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ["MAKH", "MANV", "TRIGIA", "PTVC"];
    public $timestamps = false;

    public function getNGHD(){
        return $this->NGHD;
    }
}
