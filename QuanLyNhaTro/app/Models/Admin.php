<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $table = 'admin';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'Ten_dang_nhap',
        'Mat_khau',
        'Ho_ten'
    ];

    // Cột dùng để xác thực (thay cho 'email')
    public function getAuthIdentifierName(): string
    {
        return 'Ten_dang_nhap';
    }

    // Cột mật khẩu (thay cho 'password')
    public function getAuthPasswordName(): string
    {
        return 'Mat_khau';
    }

    // Bảng admin không có cột remember_token
    public function getRememberTokenName(): string
    {
        return '';
    }
}
