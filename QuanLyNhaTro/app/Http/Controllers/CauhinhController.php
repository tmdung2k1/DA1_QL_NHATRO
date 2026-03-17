<?php

namespace App\Http\Controllers;

use App\Models\Cauhinh;
use Illuminate\Http\Request;

class CauhinhController extends Controller
{
    // Hiển thị trang cấu hình
    public function index()
    {
        // Lấy dòng cấu hình đầu tiên
        $cauhinh = Cauhinh::first();
        return view('cai_dat.index', compact('cauhinh'));
    }
    //Cập nhật thông tin
    public function update(Request $request)
    {
        $request->validate([

            'ten_nha_tro' => 'required',
            'gia_dien' => 'required|numeric|min:0',
            'gia_nuoc' => 'required|numeric|min:0',
        ]);

        $cauhinh = Cauhinh::first();
        if ($cauhinh) {
            $cauhinh->update([
                'ten_nha_tro' => $request->ten_nha_tro,
                'gia_dien' => $request->gia_dien,
                'gia_nuoc' => $request->gia_nuoc,
            ]);
        } else {
            // Trường hợp bảng cấu hình rỗng, tạo bản ghi mặc định đầu tiên.
            Cauhinh::create([
                'ten_nha_tro' => $request->ten_nha_tro,
                'gia_dien' => $request->gia_dien,
                'gia_nuoc' => $request->gia_nuoc,
            ]);
        }

        return redirect()->back()
            ->with('thongbao', 'Đã cập nhật cấu hình hệ thống!');
    }
}
