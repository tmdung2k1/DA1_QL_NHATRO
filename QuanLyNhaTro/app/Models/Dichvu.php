<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Dichvu extends Model
{
    use HasFactory;
    protected $table = 'dichvu';
    protected $primaryKey = 'Ma_dich_vu';
    public $timestamps = false;
    protected $fillable = [
        'Ten_dich_vu',
        'Don_vi_tinh',
        'Don_gia'
    ];
}
