<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hopdong extends Model
{
    use HasFactory;
    protected $table = 'hopdong';
    protected $primaryKey = 'Ma_hop_dong';
    protected $fillable = [
        'Ma_phong',
        'Ma_khach',
        'Ngay_bat_dau',
        'Ngay_ket_thuc',
        'Tien_coc',
        'Gia_phong_thuc_te',
        'Trang_thai'
    ];
}
