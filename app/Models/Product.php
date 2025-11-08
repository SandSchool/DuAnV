<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // dieu chinh khoa chinh truy van
    protected $primaryKey = "MASP";
    protected $keyType = "string";
    public $incrementing = false;
    public $timestamps = false; // bo qua 2 cot: created_at va updated_at

    protected $fillable = ["TENSP", "HINHANH", "DVT", "NUOCSX", "GIA", "MOTA", "LOAI"];

    // tao local scope cho model Product
    public function scopeIsDeleted($query)
    {
        return $query->where("XOA", "=", 0);
    }
}
