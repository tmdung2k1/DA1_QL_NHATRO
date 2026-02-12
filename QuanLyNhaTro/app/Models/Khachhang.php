<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khachhang extends Model
{
    use HasFactory;
    protected $table = 'khachhang';
    protected $primaryKey = 'Ma_khach';
    protected $fillable = [
        'Ho_ten',
        'Cccd',
        'Sdt',
        'Que_quan',
        'Email',
        'Ngay_vao',
        'Trang_thai'
    ];
}
