<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    use HasFactory;
    protected $table = 'phong';
    protected $primaryKey = 'Ma_phong';
    protected $fillable = [
        'Ten_phong',
        'Ma_loai_phong',
        'Trang_thai'
    ];
}
