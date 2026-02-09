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
    Route::get('/sua/{id}', [LoaiphongController::class, 'edit'])->name('loaiphong.edit');// sửa loại phòng
    Route::post('/cap-nhat/{id}', [LoaiphongController::class, 'update'])->name('loaiphong.update');// cập nhật loại phòng
    Route::get('/xoa/{id}', [LoaiphongController::class, 'destroy'])->name('loaiphong.destroy');// xóa loại phòng
});