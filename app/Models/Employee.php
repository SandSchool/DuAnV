<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $primaryKey = "MANV";
    protected $keyType = "string";
    public $incrementing = false;

    public function getAuthPassword()
    {
        return $this->MATKHAU;
    }

    public function isAdmin(){
        // Kiểm tra người dùng có phải là nhóm "Admin" hay không
        return $this->NHOM = 1;
    }
}
