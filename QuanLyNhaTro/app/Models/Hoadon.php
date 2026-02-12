<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hoadon extends Model
{
    use HasFactory;
    protected $table = 'hoadon';
    protected $primaryKey = 'Ma_hoa_don';
    protected $fillable = [
        'Ma_hop_dong',
        'Thang',
        'Nam',
        'Ngay_lap',
        'Tong_tien',
        'Trang_thai'
    ];
}
