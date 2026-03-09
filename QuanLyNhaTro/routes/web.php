<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CauhinhController;
use App\Http\Controllers\DichvuController;
use App\Http\Controllers\HoadonController;
use App\Http\Controllers\HopdongController;
use App\Http\Controllers\KhachhangController;
use App\Http\Controllers\LoaiphongController;
use App\Http\Controllers\PhongController;
use App\Http\Controllers\ThongkeController;
use App\Models\Dichvu;
use Illuminate\Support\Facades\Route;

//Định nghĩa các route cho ứng dụng quản lý nhà trọ
Route::get('/dang-nhap', [AuthController::class, 'login'])->name('login');
Route::post('/dang-nhap', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/dang-xuat', [AuthController::class, 'logout'])->name('logout');
//KHÓA TẤT CẢ CÁC ROUTE CHỈ CHO PHÉP TRUY CẬP TRANG ĐĂNG NHẬP
Route::middleware(['auth'])->group(function () {
    //nhóm cac route liên quan đến loại phòng
    Route::prefix('loai_phong')->group(function () {
        Route::get('/', [LoaiphongController::class, 'index'])->name('loaiphong.index'); //danh sách loại phòng
        Route::get('/them-moi', [LoaiphongController::class, 'create'])->name('loaiphong.create'); // thêm mới loại phòng
        Route::post('/luu', [LoaiphongController::class, 'store'])->name('loaiphong.store'); // lưu loại phòng
        Route::get('/sua/{id}', [LoaiphongController::class, 'edit'])->name('loaiphong.edit'); // sửa loại phòng
        Route::post('/cap-nhat/{id}', [LoaiphongController::class, 'update'])->name('loaiphong.update'); // cập nhật loại phòng
        Route::get('/xoa/{id}', [LoaiphongController::class, 'destroy'])->name('loaiphong.destroy'); // xóa loại phòng
    });
    //nhóm các route liên quan đến phòng
    Route::prefix('phong')->group(function () {
        Route::get('/', [PhongController::class, 'index'])->name('phong.index'); //danh sách phòng
        Route::get('/them-moi', [PhongController::class, 'create'])->name('phong.create'); // thêm mới phòng
        Route::post('/luu', [PhongController::class, 'store'])->name('phong.store'); // lưu phòng
        Route::get('/sua/{id}', [PhongController::class, 'edit'])->name('phong.edit'); // sửa phòng
        Route::post('/cap-nhat/{id}', [PhongController::class, 'update'])->name('phong.update'); // cập nhật phòng
        Route::get('/xoa/{id}', [PhongController::class, 'destroy'])->name('phong.destroy'); // xóa phòng
    });
    //nhóm các route liên quan đến khách hàng
    Route::prefix('khach_hang')->group(function () {
        Route::get('/', [KhachhangController::class, 'index'])->name('khachhang.index'); //danh sách khách hàng
        Route::get('/them-moi', [KhachhangController::class, 'create'])->name('khachhang.create'); // thêm mới khách hàng
        Route::post('/luu', [KhachhangController::class, 'store'])->name('khachhang.store'); // lưu khách hàng
        Route::get('/sua/{id}', [KhachhangController::class, 'edit'])->name('khachhang.edit'); // sửa khách hàng
        Route::post('/cap-nhat/{id}', [KhachhangController::class, 'update'])->name('khachhang.update'); // cập nhật khách hàng
        Route::get('/xoa/{id}', [KhachhangController::class, 'destroy'])->name('khachhang.destroy'); // xóa khách hàng
    });
    //nhóm các route liên quan đến hợp đồng
    Route::prefix('hop_dong')->group(function () {
        Route::get('/', [HopdongController::class, 'index'])->name('hopdong.index'); //danh sách hợp đồng
        Route::post('/luu', [HopdongController::class, 'store'])->name('hopdong.store'); // lưu hợp đồng
        Route::get('/them-moi', [HopdongController::class, 'create'])->name('hopdong.create'); // thêm mới hợp đồng
        Route::get('/thanh-ly/{id}', [HopdongController::class, 'terminate'])->name('hopdong.terminate'); // thanh lý hợp đồng
        Route::get('/chi-tiet/{id}', [HopdongController::class, 'show'])->name('hopdong.show'); // chi tiết hợp đồng
    });
    //nhóm các route liên quan đến hóa đơn
    Route::prefix('hoa_don')->group(function () {
        Route::get('/', [HoadonController::class, 'index'])->name('hoadon.index'); //danh sách hóa đơn
        Route::get('/lap-moi', [HoadonController::class, 'create'])->name('hoadon.create'); // tạo mới hóa đơn
        Route::post('/luu', [HoadonController::class, 'store'])->name('hoadon.store'); // lưu hóa đơn
        Route::get('/xoa/{id}', [HoadonController::class, 'destroy'])->name('hoadon.destroy'); // xóa hóa đơn
        //route ajax lấy chỉ số cũ
        Route::get('/lay-chi-so/{id}', [HoadonController::class, 'layChiSoCu']);
        Route::get('/thanh-toan/{id}', [HoadonController::class, 'thanhtoan'])->name('hoadon.thanhtoan'); // thanh toán hóa đơn
        Route::get('/in/{id}', [HoadonController::class, 'print'])->name('hoadon.print'); // in hóa đơn
    });

    //Route Trang chủ
    Route::get('/', [ThongkeController::class, 'index'])->name('trangchu');

    //Route cấu hình hệ thống
    Route::prefix('cai_dat')->group(function () {
        Route::post('/cap-nhat', [CauhinhController::class, 'update'])->name('caidat.update'); // cập nhật cấu hình
    });
    //quản lý dịch vụ
    Route::prefix('dich_vu')->group(function (){
        Route::get('/', [DichvuController::class, 'index'])->name('dichvu.index'); // danh sách dịch vụ
        Route::post('/them', [DichvuController::class, 'store'])->name('dichvu.store'); // thêm dịch vụ
        Route::get('/xoa/{id}', [DichvuController::class, 'destroy'])->name('dichvu.destroy'); // xóa dịch vụ
    });
});
