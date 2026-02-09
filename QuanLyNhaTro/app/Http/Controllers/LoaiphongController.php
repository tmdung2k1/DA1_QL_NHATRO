<?php

namespace App\Http\Controllers;

use App\Models\Loaiphong;
use Illuminate\Http\Request;

class LoaiphongController extends Controller
{
    // Hiển thị danh sách loại phòng
    public function index()
    {
        $ds_loaiphong = Loaiphong::orderBy('ma_loai_phong', 'asc')->get();
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
    // Hiển thị form sửa loại phòng
    public function edit($id)
    {
        // Tìm loại phòng theo id
        $loaiphong = Loaiphong::find($id);
        if (!$loaiphong) return abort(404);
        return view('loai_phong.edit', compact('loaiphong'));
    }
    // Xử lý cập nhật loại phòng
    public function update(Request $request, $id)
    {
        $request->validate([
            'Ten_loai_phong' => 'required|max:50',
            'Don_gia' => 'required|numeric|min:0',
        ]);
        //tim va cap nhat loai phong
        $loaiphong = Loaiphong::find($id);
        $loaiphong->update([
            'Ten_loai_phong' => $request->Ten_loai_phong,
            'Don_gia' => $request->Don_gia,
            'Mo_ta' => $request->Mo_ta
        ]);
        //chuyen huong ve trang danh sach loai phong voi thong bao
        return redirect()->route('loaiphong.index')
            ->with('thongbao', 'Cập nhật loại phòng thành công!');
    }
    // Xóa loại phòng
    public function destroy($id)
    {
        $loaiphong = Loaiphong::find($id);
        if ($loaiphong) {
            $loaiphong->delete();
            return redirect()->route('loaiphong.index')
                ->with('thongbao', 'Đã xóa loại phòng!');
        }
        return redirect()->route('loaiphong.index')
            ->with('error', 'Không tìm thấy loại phòng!');
    }
}
