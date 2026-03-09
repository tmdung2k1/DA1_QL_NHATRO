<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hoadon extends Model
{
    use HasFactory;
    protected $table = 'hoadon';
    protected $primaryKey = 'Ma_hoa_don';
    public $timestamps = false;
    protected $fillable = [
        'Ma_hop_dong',
        'Thang',
        'Nam',
        'Ngay_lap',
        'Chi_so_dien_cu',
        'Chi_so_dien_moi',
        'Chi_so_nuoc_cu',
        'Chi_so_nuoc_moi',
        'Tien_dien',
        'Tien_nuoc',
        'Tien_phong',
        'Tong_tien',
        'Trang_thai'
    ];
    public function hopdong()
    {
        return $this->belongsTo(Hopdong::class, 'Ma_hop_dong', 'Ma_hop_dong');
    }
    public function chitiethoadon()
    {
        return $this->hasMany(Chitiethoadon::class, 'Ma_hoa_don', 'Ma_hoa_don');
    }
}
