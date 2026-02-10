<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Phong extends Model
{
    use HasFactory;
    protected $table = 'phong';
    protected $primaryKey = 'Ma_phong';
    public $timestamps = false;
    protected $fillable = [
        'Ten_phong',
        'Ma_loai_phong',
        'Trang_thai'
    ];
    //khoa ngoai
    public function loaiphong()
    {
        return $this->belongsTo(Loaiphong::class, 'Ma_loai_phong', 'Ma_loai_phong'); //belongsTo dung de khai bao quan he n-1
    }
}
