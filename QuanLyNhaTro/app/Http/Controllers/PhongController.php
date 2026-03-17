<?php

namespace App\Http\Controllers;

use App\Models\Hopdong;
use App\Models\Loaiphong;
use App\Models\Phong;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PhongController extends Controller
{
    //danh sach phong
    public function index()
    {
        //lay danh sach phong va thong tin loai phong
        $ds_phong = Phong::with('loaiphong')
            ->orderBy('Ma_phong', 'asc')->get();
        $ds_loaiphong = Loaiphong::all();
        return view('phong.index', compact('ds_phong', 'ds_loaiphong'));
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
    //sua phong 
    public function edit($id)
    {
        //lay thong tin phong can sua
        $phong = Phong::find($id);
        //lay danh sach loai phong de chon
        $ds_loaiphong = Loaiphong::all();
        return view('phong.edit', compact('phong', 'ds_loaiphong'));
    }
    //cap nhat phong
    public function update(Request $request, $id)
    {
        $request->validate([
            'Ten_phong' => 'required|max:50',
            'Ma_loai_phong' => 'required',
            'Trang_thai' => 'required'
        ]);
        //tim va cap nhat phong
        $phong = Phong::find($id);
        $phong->update([
            'Ten_phong' => $request->Ten_phong,
            'Ma_loai_phong' => $request->Ma_loai_phong,
            'Trang_thai' => $request->Trang_thai
        ]);
        //chuyen huong ve trang danh sach phong voi thong bao
        return redirect()->route('phong.index')
            ->with('thongbao', 'Cập nhật phòng thành công!');
    }
    //xoa phong
    public function destroy($id)
    {
        $phong = Phong::find($id);

        if (!$phong) {
            return redirect()->route('phong.index')
                ->with('error', 'Không tìm thấy phòng cần xóa.');
        }

        // Không cho xóa khi phòng đang có hợp đồng hiệu lực.
        $coHopDongDangThue = Hopdong::where('Ma_phong', $id)
            ->where('Trang_thai', 1)
            ->exists();

        if ($coHopDongDangThue) {
            return redirect()->route('phong.index')
                ->with('error', 'Không thể xóa phòng vì hiện đang có người thuê. Vui lòng thanh lý hợp đồng trước.');
        }

        // Có lịch sử hợp đồng cũng không thể xóa do ràng buộc khóa ngoại.
        $coLichSuHopDong = Hopdong::where('Ma_phong', $id)->exists();
        if ($coLichSuHopDong) {
            return redirect()->route('phong.index')
                ->with('error', 'Không thể xóa phòng vì đã phát sinh hợp đồng liên quan.');
        }

        try {
            $phong->delete();
        } catch (QueryException $e) {
            return redirect()->route('phong.index')
                ->with('error', 'Không thể xóa phòng do dữ liệu đang được sử dụng ở nơi khác.');
        }

        return redirect()->route('phong.index')
            ->with('thongbao', 'Xóa phòng thành công');
    }
}
