<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cauhinh extends Model
{
    use HasFactory;
    protected $table = 'cauhinh';
    protected $primaryKey = 'Ma_CH';
    public $timestamps = true;
    protected $fillable = ['ten_nha_tro', 'gia_dien', 'gia_nuoc'];
}
