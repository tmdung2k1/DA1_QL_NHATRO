<?php

namespace App\Http\Controllers;

use App\Models\Loaiphong;
use App\Models\Phong;
use Illuminate\Http\Request;

class PhongController extends Controller
{
    //danh sach phong
    public function index()
    {
        //lay danh sach phong va thong tin loai phong
        $ds_phong = Phong::with('loaiphong')
        ->orderBy('Ma_phong', 'asc')->get();
        return view('phong.index', compact('ds_phong'));
    }
    //them form moi
    public function create()
    {
        //lay danh sach loai phong de chon
        $ds_loaiphong = Loaiphong::all();
        return view('phong.create', compact('ds_loaiphong'));
    }
    //luu phong moi
    public function store(Request $request)
    {
        $request->validate([
            'Ten_phong' => 'required|max:50',
            'Ma_loai_phong' => 'required',
            'Trang_thai' => 'required'
        ]);
        Phong::create([
            'Ten_phong' => $request->Ten_phong,
            'Ma_loai_phong' => $request->Ma_loai_phong,
            'Trang_thai' => $request->Trang_thai
        ]);
        return redirect()->route('phong.index')
        ->with('thongbao', 'Thêm phòng thành công');
    }
    //xoa phong
    public function destroy($id)
    {
        Phong::destroy($id);
        return redirect()->route('phong.index')
        ->with('thongbao', 'Xóa phòng thành công');
    }
}
