<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admin';
    protected $primarykey = 'Id';
    protected $fillable = [
        'Ten_dang_nhap',
        'mat_khau',
        'Ho_ten'
    ];
}
