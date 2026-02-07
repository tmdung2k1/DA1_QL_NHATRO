<?php

namespace App\Http\Controllers;

use App\Models\Loaiphong;
use Illuminate\Http\Request;

class LoaiphongController extends Controller
{
    // Hiển thị danh sách loại phòng
    public function index()
    {
        $ds_loaiphong = Loaiphong::orderBy('ma_loai_phong', 'desc')->get();
        return view('loai_phong.index', compact('ds_loaiphong'));
    }
    // Hiển thị form them loại phòng mới
    public function create()
    {
        return view('loai_phong.create');
    }
   // Xử lý lưu dữ liệu vào CSDL
   public function store(Request $request)
   {
    // Validate dữ liệu
    $request->validate([
        'Ten_loai_phong' => 'required|max:50',
        'Don_gia' => 'required|numeric|min:0',
    ]);
    //lưu dữ liệu vào bảng Loaiphong
    Loaiphong::create([
        'Ten_loai_phong' => $request->Ten_loai_phong,
        'Don_gia' => $request->Don_gia,
        'Mo_ta' => $request->Mo_ta
    ]);
    // Chuyển hướng về trang danh sách loại phòng với thông báo thành công
    return redirect()->route('loaiphong.index')
    ->with('thongbao', 'Thêm loại phòng thành công!');
   }
}
