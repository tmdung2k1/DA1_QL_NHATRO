<?php

namespace App\Http\Controllers;
use App\Models\Phong;
use App\Models\Hopdong;
use App\Models\Khachhang;
use App\Models\Hoadon;
use Carbon\Carbon; // Thêm thư viện Carbon để xử lý thời gian
use Illuminate\Http\Request;

class ThongkeController extends Controller
{
    public function index()
    {
        //Thống kê số lượng phòng trọ
        $tong_phong = Phong::count();
        $phong_trong = Phong::where('Trang_thai', 0)->count();
        $phong_co_khach = Phong::where('Trang_thai', 1)->count();

        //Thống kê Khách hàng
        $tong_khach = Khachhang::count();

        //Thống kê Doanh thu Tháng này
        $thang_nay = Carbon::now()->month;
        $nam_nay = Carbon::now()->year;

        //Tính tổng tiền từ các hóa đơn ĐÃ THANH TOÁN trong tháng này
        $doanh_thu = Hoadon::where('Thang', $thang_nay)
        ->where('Nam', $nam_nay)
        ->where('Trang_thai', 1) // Chỉ tính các hóa đơn đã thanh toán
        ->sum('Tong_tien');
        //Đếm số hóa đơn chưa thu tiền
        $hoa_don_chua_thu = Hoadon::where('Trang_thai', 0)->count();

        return view('trang_chu', compact(
            'tong_phong',
            'phong_trong',
            'phong_co_khach',
            'tong_khach',
            'doanh_thu',
            'hoa_don_chua_thu',
            'thang_nay', 'nam_nay'
        ));
    }
}
