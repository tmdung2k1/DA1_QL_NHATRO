<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cauhinh extends Model
{
    use HasFactory;
    protected $table = 'cauhinh';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = ['ten_nha_tro', 'gia_dien', 'gia_nuoc'];
}
