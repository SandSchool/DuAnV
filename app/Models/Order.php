<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'SOHD'; // Khóa chính là SOHD

    // --- QUAN TRỌNG: TẮT TIMESTAMPS ---
    public $timestamps = false;

    // --- MỚI THÊM: ÉP KIỂU DỮ LIỆU ---
    // Dòng này giúp Laravel tự động hiểu NGHD là đối tượng ngày tháng (Carbon)
    protected $casts = [
        'NGHD' => 'datetime',
    ];

    protected $fillable = [
        'SOHD',
        'MAKH',
        'MANV',
        'TRIGIA',
        'PTVC',
        'token',
        'TRANGTHAI',
        'NGHD',
    ];
    // Quan hệ với OrderDetail
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'SOHD', 'SOHD');
    }
    // Quan hệ với Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'MAKH', 'MAKH');
    }
}
