<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = "MALOAI";
    protected $keyType = "string";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ["TENLOAI", "HINHANH", "MOTA"];

    public function scopeIsDeleted($query){
        return $this->where("XOA", "=", 0);
    }
}
