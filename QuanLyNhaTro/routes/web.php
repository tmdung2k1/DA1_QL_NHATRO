<?php

use App\Http\Controllers\HopdongController;
use App\Http\Controllers\KhachhangController;
use App\Http\Controllers\LoaiphongController;
use App\Http\Controllers\PhongController;
use App\Models\Khachhang;
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
//nhóm các route liên quan đến phòng
Route::prefix('phong')->group(function (){
    Route::get('/', [PhongController::class, 'index'])->name('phong.index');//danh sách phòng
    Route::get('/them-moi', [PhongController::class, 'create'])->name('phong.create'); // thêm mới phòng
    Route::post('/luu', [PhongController::class, 'store'])->name('phong.store'); // lưu phòng
    Route::get('/sua/{id}', [PhongController::class, 'edit'])->name('phong.edit'); // sửa phòng
    Route::post('/cap-nhat/{id}', [PhongController::class, 'update'])->name('phong.update'); // cập nhật phòng
    Route::get('/xoa/{id}', [PhongController::class, 'destroy'])->name('phong.destroy'); // xóa phòng
});
//nhóm các route liên quan đến khách hàng
Route::prefix('khach_hang')->group(function (){
    Route::get('/', [KhachhangController::class, 'index'])->name('khachhang.index');//danh sách khách hàng
    Route::get('/them-moi', [KhachhangController::class, 'create'])->name('khachhang.create');// thêm mới khách hàng
    Route::post('/luu', [KhachhangController::class, 'store'])->name('khachhang.store');// lưu khách hàng
    Route::get('/sua/{id}', [KhachhangController::class, 'edit'])->name('khachhang.edit');// sửa khách hàng
    Route::post('/cap-nhat/{id}', [KhachhangController::class, 'update'])->name('khachhang.update');// cập nhật khách hàng
    Route::get('/xoa/{id}', [KhachhangController::class, 'destroy'])->name('khachhang.destroy');// xóa khách hàng
});
//nhóm các route liên quan đến hợp đồng
Route::prefix('hop-dong')->group(function (){
    Route::get('/', [HopdongController::class, 'index'])->name('hopdong.index'); //danh sách hợp đồng
    Route::post('/luu', [HopdongController::class, 'store'])->name('hopdong.store'); // lưu hợp đồng
    Route::get('/them-moi', [HopdongController::class, 'create'])->name('hopdong.create'); // thêm mới hợp đồng
});