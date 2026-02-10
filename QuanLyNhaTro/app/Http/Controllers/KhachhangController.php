<?php

namespace App\Http\Controllers;

use App\Models\Khachhang;
use Illuminate\Http\Request;

class KhachhangController extends Controller
{
    //danh sách khách hàng
    public function index()
    {
        $ds_khach = Khachhang::orderby('Ma_khach', 'asc')->get();
        return view('khach_hang.index', compact('ds_khach'));
    }
    //form thêm khách hàng
    public function create()
    {
        return view('khach_hang.create');
    }
    //luu khách hàng
    public function store(Request $request)
    {
        //validate dữ liệu
        $request->validate([
            'Ho_ten' => 'required|max:50',
            //kiểm tra cccd không được trùng
            'Cccd' => 'required|numeric|unique:KHACHHANG,Cccd',
            'Sdt' => 'required|numeric',
            'Que_quan' => 'required'
        ], [
            'Cccd.unique' => 'CCCD đã tồn tại trong hệ thống!',
            'Cccd.numeric' => 'CCCD phải là số!',
            'Sdt.numeric' => 'Số điện thoại phải là số!',
        ]);
        Khachhang::create([
            'Ho_ten' => $request->Ho_ten,
            'Cccd' => $request->Cccd,
            'Sdt' => $request->Sdt,
            'Que_quan' => $request->Que_quan,
            'Email' => $request->Email,
            'Ngay_vao' => $request->Ngay_vao,
            'Trang_thai' => 1 //mặc định trạng thái là đang ở
        ]);
        return redirect()->route('khachhang.index')
            ->with('thongbao', 'Thêm khách hàng thành công!');
    }
    //sửa khách hàng
    public function edit($id)
    {
        //lấy thông tin khách hàng cần sửa
        $khachhang = Khachhang::find($id);
        if (!$khachhang) return abort(404);
        return view('khach_hang.edit', compact('khachhang'));
    }
    //cập nhật khách hàng
    public function update(Request $request, $id)
    {
        $request->validate([
            'Ho_ten' => 'required|max:50',
            'Cccd' => 'required|numeric',
            'Sdt' => 'required|numeric',
            'Que_quan' => 'required'
        ], [
            'Cccd.numeric' => 'CCCD phải là số!',
            'Sdt.numeric' => 'Số điện thoại phải là số!',
        ]);
        //tìm và cập nhật khách hàng
        $khachhang = Khachhang::find($id);
        $khachhang->update([
            'Ho_ten' => $request->Ho_ten,
            'Cccd' => $request->Cccd,
            'Sdt' => $request->Sdt,
            'Que_quan' => $request->Que_quan,
            'Email' => $request->Email,
            'Ngay_vao' => $request->Ngay_vao,
            'Trang_thai' => $request->Trang_thai
        ]);
        //chuyển hướng về trang danh sách khách hàng với thông báo
        return redirect()->route('khachhang.index')
            ->with('thongbao', 'Cập nhật khách hàng thành công!');
    }
    //xóa khách hàng
    public function destroy($id)
    {
        //kiểm tra khách hàng có hợp đồng không trước khi xóa
        Khachhang::destroy($id);
        return redirect()->route('khachhang.index')
            ->with('thongbao', 'Đã xóa khách hàng!');
    }
}
