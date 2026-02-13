<?php

namespace App\Http\Controllers;

use App\Models\Hopdong;
use App\Models\Khachhang;
use App\Models\Phong;
use Illuminate\Http\Request;

class HopdongController extends Controller
{
    public function index()
    {
        //Lấy hợp đồng kèm thông tin Phòng và Khách để hiển thị tên
        $ds_hopdong = Hopdong::with(['phong', 'khach'])
        ->orderBy('Ma_hop_dong', 'asc')
        ->get();

        // Lấy danh sách Phòng TRỐNG để cho vào Dropdown tạo hợp đồng mới
        $phong_trong = Phong::where('Trang_thai', 0)->get();
        // Lấy danh sách Khách hàng
        $ds_khach = Khachhang::all();
        return view('hop_dong.index', compact('ds_hopdong', 'phong_trong', 'ds_khach'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'Ma_phong' => 'required',
            'Ma_khach' => 'required',
            'Ngay_bat_dau' => 'required|date',
            'Gia_phong_thuc_te' => 'required|numeric'
        ]);

        // Tạo hợp đồng mới
        Hopdong::create([
            'Ma_phong' => $request->Ma_phong,
            'Ma_khach' => $request->Ma_khach,
            'Ngay_bat_dau' => $request->Ngay_bat_dau,
            'Ngay_ket_thuc' => $request->Ngay_ket_thuc,
            'Gia_phong_thuc_te' => $request->Gia_phong_thuc_te,
            'Trang_thai' => 1
        ]);
        //Cập nhật trạng thái Phòng thành "Đang thuê" (Trạng thái = 1)
        $phong = Phong::find($request->Ma_phong);
        $phong->Trang_thai = 1;
        $phong->save();

        return redirect()->route('hopdong.index')
        ->with('thongbao', 'Hợp đồng đã được tạo thành công!');
    }
}
