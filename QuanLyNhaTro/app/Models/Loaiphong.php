<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loaiphong extends Model
{
    use HasFactory; //dung de su dung factory de tao du lieu ao
    //khai bao ten bang
    protected $table = 'loaiphong';
    //khai bao khoa chinh
    protected $primarykey = 'Ma_loai_phong';
    //khai bao cot duoc phep gan gia tri
    protected $fillable = [ 
        'Ten_loai_phong',
        'Don_gia',
        'Mo_ta'
    ];
}
