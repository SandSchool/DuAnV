<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    // Khóa chính bảng này là 'id' (theo SQL dump) nên không cần khai báo $primaryKey

    // 1. Tắt timestamp (Vì bảng này không có cột created_at/updated_at)
    public $timestamps = false;

    // 2. Các cột được phép thêm
    protected $fillable = [
        'SOHD',
        'MASP',
        'SL',     // Số lượng
        'GIAGOC',
        'GIABAN'
    ];

    // Quan hệ ngược về Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'SOHD', 'SOHD');
    }

    // Quan hệ về Product (để lấy tên, ảnh sản phẩm)
    public function product()
    {
        // Lưu ý: Khóa chính của Product là MASP
        return $this->belongsTo(Product::class, 'MASP', 'MASP');
    }
}
