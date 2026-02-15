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
        return view('hopdong.index', compact('ds_hopdong'));
    }
    public function create()
    {
        // Lấy danh sách Phòng TRỐNG để cho vào Dropdown
        $phong_trong = Phong::where('Trang_thai', 0)->get();
        // Lấy danh sách Khách hàng
        $ds_khach = Khachhang::all();

        return view('hopdong.create', compact('phong_trong', 'ds_khach'));
    }
    // Lưu hợp đồng mới
    public function store(Request $request)
    {
        $request->validate([
            'Ma_phong' => 'required',
            'Ma_khach' => 'required',
            'Ngay_bat_dau' => 'required|date',
            'Gia_phong_thuc_te' => 'required|numeric',
            'Chi_so_dien_dau' => 'required|numeric|min:0',
            'Chi_so_nuoc_dau' => 'required|numeric|min:0',
        ]);

        // Tạo hợp đồng mới
        Hopdong::create([
            'Ma_phong' => $request->Ma_phong,
            'Ma_khach' => $request->Ma_khach,
            'Ngay_bat_dau' => $request->Ngay_bat_dau,
            'Ngay_ket_thuc' => $request->Ngay_ket_thuc,
            'Tien_coc' => $request->Tien_coc ?? 0,
            'Gia_phong_thuc_te' => $request->Gia_phong_thuc_te,
            'Chi_so_dien_dau' => $request->Chi_so_dien_dau,
            'Chi_so_nuoc_dau' => $request->Chi_so_nuoc_dau,
            'Trang_thai' => 1
        ]);
        //Cập nhật trạng thái Phòng thành "Đang thuê" (Trạng thái = 1)
        $phong = Phong::find($request->Ma_phong);
        $phong->Trang_thai = 1;
        $phong->save();

        return redirect()->route('hopdong.index')
            ->with('thongbao', 'Hợp đồng đã được tạo thành công!');
    }
    //Xử lý Thanh lý (Check-out)
    public function terminate($id)
    {
        $hopdong = Hopdong::find($id);
        if (!$hopdong) return redirect()->back(); //nếu không tìm thấy hợp đồng thì quay về trang trước đó
        // Kết thúc Hợp đồng
        $hopdong->Trang_thai = 0; //Cập nhật trạng thái hợp đồng là đã kết thúc
        $hopdong->Ngay_ket_thuc = date('Y-m-d');
        $hopdong->save();
        //Trả phòng về TRỐNG
        $phong = Phong::find($hopdong->Ma_phong);
        if ($phong) {
            $phong->Trang_thai = 0; //Cập nhật trạng thái phòng là TRỐNG
            $phong->save();
        }
        return redirect()->route('hopdong.index')
            ->with('thongbao', 'Hợp đồng đã được thanh lý thành công.Phòng đã trống!');
    }
    //Xem chi tiết hợp đồng
    public function show($id)
    {
        //lấy thông tin hợp đồng kèm theo thông tin phòng và khách hàng
        $hopdong = Hopdong::with(['phong', 'khach'])->find($id);
        if(!$hopdong){
            return redirect()->route('hopdong.index')
            ->with('error', 'Không tìm thấy hợp đồng!');
        }
        return view('hopdong.show', compact('hopdong'));
    }
}
