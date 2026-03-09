<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitiethoadon extends Model
{
    use HasFactory;
    protected $table = 'chitiethoadon';
    protected $primaryKey = 'Ma_cthd';
    public $timestamps = false; //tat timestamp
    protected $fillable = [
        'Ma_hoa_don',
        'Ma_dich_vu',
        'Chi_so_cu',
        'Chi_so_moi',
        'So_luong_su_dung',
        'Thanh_tien',
    ];

    public function dichvu()
    {
        return $this->belongsTo(Dichvu::class, 'Ma_dich_vu', 'Ma_dich_vu');
    }
}
