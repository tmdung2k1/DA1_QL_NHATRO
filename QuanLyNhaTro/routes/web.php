<?php

use App\Http\Controllers\LoaiphongController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('tong_quan.index');
});
//nhóm cac route liên quan đến loại phòng
Route::prefix('loai_phong')->group(function (){
    Route::get('/', [LoaiphongController::class, 'index'])->name('loaiphong.index');//danh sách loại phòng
    Route::get('/them-moi', [LoaiphongController::class, 'create'])->name('loaiphong.create');// thêm mới loại phòng
    Route::post('/luu', [LoaiphongController::class, 'store'])->name('loaiphong.store');// lưu loại phòng
});