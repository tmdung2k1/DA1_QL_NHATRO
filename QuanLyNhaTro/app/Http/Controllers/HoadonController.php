<?php

namespace App\Http\Controllers;

use App\Models\Hoadon;
use App\Models\Hopdong;
use Illuminate\Http\Request;

class HoadonController extends Controller
{
    //hiển thị danh sách hóa đơn
    public function index()
    {
        $ds_hoadon = Hoadon::with(['hopdong.phong', 'hopdong.khach'])->orderBy('Ma_hoa_don', 'asc')->get();
        return view('hoa_don.index', compact('ds_hoadon'));
    }
    //hiển thị form tạo hóa đơn
    public function create()
    {
        //lấy danh sách hợp đồng để chọn khi tạo hóa đơn
        $ds_hopdong = Hopdong::with(['phong', 'khach'])->where('Trang_thai', 1)->get();
        return view('hoa_don.create', compact('ds_hopdong'));
    }
    //ajax Tự động lấy chỉ số cũ
    public function layChiSoCu($ma_hop_dong)
    {
        //Tìm hóa đơn gần nhất của hợp đồng 
        $hoadon_cu = Hoadon::where('Ma_hop_dong', $ma_hop_dong)
            ->orderBy('Ma_hoa_don', 'desc')
            ->first();

        if ($hoadon_cu) {
            // Nếu đã từng có hóa đơn -> Lấy chỉ số mới kỳ trước
            return response()->json([
                'dien_cu' => $hoadon_cu->Chi_so_dien_moi,
                'nuoc_cu' => $hoadon_cu->Chi_so_nuoc_moi,
                'gia_phong' => $hoadon_cu->hopdong->Gia_phong_thuc_te
            ]);
        } else {
            // Nếu chưa có hóa đơn nào -> Lấy chỉ số đầu trong Hợp đồng
            $hopdong = Hopdong::find($ma_hop_dong);
            return response()->json([
                'dien_cu' => $hopdong->Chi_so_dien_dau,
                'nuoc_cu' => $hopdong->Chi_so_nuoc_dau,
                'gia_phong' => $hopdong->Gia_phong_thuc_te
            ]);
        }
    }
    //lưu hóa đơn mới
    public function store(Request $request)
    {
        //lấy giá diện, nước cố định
        $GIA_DIEN = 4000;
        $GIA_NUOC = 12000;

        $dien_tieu_thu = $request->Chi_so_dien_moi - $request->Chi_so_dien_cu;
        $nuoc_tieu_thu = $request->Chi_so_nuoc_moi - $request->Chi_so_nuoc_cu;

        $tien_dien = $dien_tieu_thu * $GIA_DIEN;
        $tien_nuoc = $nuoc_tieu_thu * $GIA_NUOC;

        //lấy giá phòng từ hợp đồng
        $hopdong = Hopdong::find($request->Ma_hop_dong);
        $tien_phong = $hopdong->Gia_phong_thuc_te;

        $tong_tien = $tien_phong + $tien_dien + $tien_nuoc;

        Hoadon::create([
            'Ma_hop_dong' => $request->Ma_hop_dong,
            'Thang' => $request->Thang,
            'Nam' => $request->Nam,
            'Ngay_lap' => date('Y-m-d'), //ngày lập là ngày hiện tại
            'Chi_so_dien_cu' => $request->Chi_so_dien_cu,
            'Chi_so_dien_moi' => $request->Chi_so_dien_moi,
            'Chi_so_nuoc_cu' => $request->Chi_so_nuoc_cu,
            'Chi_so_nuoc_moi' => $request->Chi_so_nuoc_moi,
            'Tien_dien' => $tien_dien,
            'Tien_nuoc' => $tien_nuoc,
            'Tien_phong' => $tien_phong,
            'Tong_tien' => $tong_tien,
            'Trang_thai' => 0 //mặc định là chưa thanh toán
        ]);
        return redirect()->route('hoadon.index')->with('thongbao', 'Tạo hóa đơn thành công!');
    }

    //thanh toán hóa đơn
    public function thanhtoan($id)
    {
        //Tìm hóa đơn cần thanh toán
        $hoadon = Hoadon::find($id);
        if ($hoadon) {
            //Cập nhật trạng thái thành 1 (Đã thanh toán)
            $hoadon->Trang_thai = 1;
            $hoadon->save();
            return redirect()->route('hoadon.index')
                ->with('thongbao', 'Thanh toán hóa đơn thành công!');
        }
        return redirect()->back()
            ->with('error', 'Không tìm thấy hóa đơn cần thanh toán!');
    }
    //xóa hóa đơn(Chỉ cho phép xóa khi chưa thanh toán )
    public function destroy($id)
    {
        $hoadon = Hoadon::find($id);
        if (!$hoadon) {
            return redirect()->back()
                ->with('error', 'Hóa đơn không tồn tại!');
        }
        //Chỉ cho phép xóa khi hóa đơn chưa thanh toán
        if ($hoadon->Trang_thai == 1) {
            return redirect()->back()
                ->with('error', 'Hóa đơn này ĐÃ THU TIỀN, không thể xóa! Hãy giữ lại để thống kê doanh thu.');
        }
        //nếu chưa thanh toán thì mới cho xóa
        $hoadon->delete();
        return redirect()->route('hoadon.index')
        ->with('thongbao', 'Xóa hóa đơn thành công!');
    }
}
