<?php

namespace App\Http\Controllers;

use App\Models\Phong;
use App\Models\Hopdong;
use App\Models\Khachhang;
use App\Models\Hoadon;
use Carbon\Carbon; // Thêm thư viện Carbon để xử lý thời gian


class ThongkeController extends Controller
{
    public function index()
    {
        //Thống kê số lượng
        $tong_phong = Phong::count();
        $phong_trong = Phong::where('Trang_thai', 0)->count();
        $phong_co_khach = Phong::where('Trang_thai', 1)->count();
        $tong_khach = Khachhang::count();

        $thang_nay = Carbon::now()->month;
        $nam_nay = Carbon::now()->year;

        $doanh_thu = Hoadon::where('Nam', $nam_nay)
            ->where('Trang_thai', 1)
            ->sum('tong_tien');

        $hoa_don_chua_thu = Hoadon::where('Trang_thai', 0)->count();
        $labels_thang = []; // Mảng chứa tên các tháng
        $doanh_thu_thang = []; // Mảng chứa doanh thu của từng tháng

        // Lặp 6 lần để lấy 6 tháng từ quá khứ tới hiện tại
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->month; // Lấy tháng hiện tại trừ đi $i tháng
            $year = Carbon::now()->subMonths($i)->year; // Lấy năm hiện tại trừ đi $i tháng
            $labels_thang[] = "T" . $month . "/" . $year; // Thêm tên tháng vào mảng labels

            // Tính doanh thu của tháng đó
            $dt = Hoadon::where('Thang', $month)
                ->where('Nam', $year)
                ->where('Trang_thai', 1)
                ->sum('Tong_tien');
            $doanh_thu_thang[] = (int)$dt; // Thêm doanh thu vào mảng doanh_thu_thang
        }
        return view('trang_chu', compact(
            'tong_phong',
            'phong_trong',
            'phong_co_khach',
            'tong_khach',
            'doanh_thu',
            'hoa_don_chua_thu',
            'thang_nay',
            'nam_nay',
            'labels_thang',
            'doanh_thu_thang' //Truyền dữ liệu sang View
        ));
    }
}
