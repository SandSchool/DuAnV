<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Tên bảng trong database
     */
    protected $table = 'customers';

    /**
     * Primary key của bảng
     */
    protected $primaryKey = 'MAKH';

    /**
     * Kiểu dữ liệu của primary key
     */
    protected $keyType = 'string';

    /**
     * Primary key không phải auto-increment
     */
    public $incrementing = false;

    /**
     * Tắt timestamps (created_at, updated_at)
     */
    public $timestamps = false;

    /**
     * Các trường có thể gán giá trị hàng loạt (mass assignable)
     */
    protected $fillable = [
        'MAKH',
        'HOTEN',
        'EMAIL',
        'SODT',
        'DCHI',
        'MATKHAU',
        'NGSINH',
    ];

    /**
     * Các trường cần ẩn khi serialize (chuyển sang JSON/Array)
     */
    protected $hidden = [
        'MATKHAU',        // ✅ SỬA: Phải dùng MATKHAU thay vì password
        'remember_token',
    ];

    /**
     * Các trường cần cast kiểu dữ liệu
     */
    protected $casts = [
        'NGSINH' => 'date',  // ✅ THÊM: Cast NGSINH thành Carbon date
    ];

    // ============================================
    // AUTHENTICATION METHODS (QUAN TRỌNG!)
    // ============================================

    /**
     * Chỉ định tên cột password trong DB
     * Laravel mặc định tìm cột 'password', nhưng DB bạn dùng 'MATKHAU'
     * 
     * ✅ ĐÃ CÓ - Đúng rồi!
     */
    public function getAuthPassword()
    {
        return $this->MATKHAU;
    }

    /**
     * Chỉ định tên cột email/username để đăng nhập
     * Laravel mặc định tìm cột 'email', nhưng DB bạn dùng 'EMAIL'
     * 
     * ⚠️ THIẾU - CẦN THÊM CÁI NÀY!
     */
    public function getAuthIdentifierName()
    {
        return 'EMAIL';
    }

    /**
     * Lấy giá trị của identifier (email)
     * Optional nhưng nên có để đầy đủ
     */
    public function getAuthIdentifier()
    {
        return $this->EMAIL;
    }

    // ============================================
    // ACCESSORS (Optional - Giúp code dễ đọc hơn)
    // ============================================

    /**
     * Accessor để dùng $customer->name thay vì $customer->HOTEN
     */
    public function getNameAttribute()
    {
        return $this->HOTEN;
    }

    /**
     * Accessor để dùng $customer->email thay vì $customer->EMAIL
     */
    // public function getEmailAttribute()
    // {
    //     return $this->EMAIL;
    // }

    /**
     * Accessor để dùng $customer->phone thay vì $customer->SODT
     */
    public function getPhoneAttribute()
    {
        return $this->SODT;
    }

    /**
     * Accessor để dùng $customer->address thay vì $customer->DCHI
     */
    public function getAddressAttribute()
    {
        return $this->DCHI;
    }

    /**
     * Accessor để dùng $customer->birthday thay vì $customer->NGSINH
     */
    public function getBirthdayAttribute()
    {
        return $this->NGSINH;
    }

    // ============================================
    // RELATIONSHIPS (Thêm sau khi có các bảng khác)
    // ============================================

    /**
     * Một customer có nhiều orders
     * Uncomment khi đã tạo Order model
     */
    // public function orders()
    // {
    //     return $this->hasMany(Order::class, 'MAKH', 'MAKH');
    // }

    /**
     * Một customer có nhiều reviews
     * Uncomment khi đã tạo Review model
     */
    // public function reviews()
    // {
    //     return $this->hasMany(Review::class, 'MAKH', 'MAKH');
    // }
}


