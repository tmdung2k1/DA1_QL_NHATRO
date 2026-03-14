<?php

namespace App\Http\Controllers;

use App\Models\Cauhinh;
use App\Models\Hoadon;
use App\Models\Hopdong;
use Illuminate\Http\Request;
use App\Models\Dichvu;
use App\Models\Chitiethoadon;

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
        //Lấy danh sách hợp đồng đang hoạt động để chọn khi tạo hóa đơn
        $ds_hopdong = Hopdong::where('Trang_thai', 1)
            ->with(['phong', 'khach'])->get();
        //lấy dịch vu đang có
        $dichvu = Dichvu::all();
        return view('hoa_don.create', compact('ds_hopdong', 'dichvu'));
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
        //Kiểm tra dữ liệu đầu vào
        $request->validate([
            'Ma_hop_dong' => 'required',
            'Thang' => 'required|numeric|min:1|max:12',
            'Nam' => 'required|numeric',
            'Chi_so_dien_moi' => 'required|numeric|gte:Chi_so_dien_cu',
            'Chi_so_nuoc_moi' => 'required|numeric|gte:Chi_so_nuoc_cu',
        ], [
            'Chi_so_dien_moi.gte' => 'Chỉ số điện mới phải lớn hơn hoặc bằng chỉ số cũ!',
            'Chi_so_nuoc_moi.gte' => 'Chỉ số nước mới phải lớn hơn hoặc bằng chỉ số cũ!',
        ]);
        //Lấy giá Điện, Nước từ Cấu hình và Giá phòng từ Hợp đồng
        $cauhinh = \App\Models\Cauhinh::first();
        $hopdong = Hopdong::find($request->Ma_hop_dong);

        $so_dien = $request->Chi_so_dien_moi - $request->Chi_so_dien_cu;
        $so_nuoc = $request->Chi_so_nuoc_moi - $request->Chi_so_nuoc_cu;

        $tien_dien = $so_dien * $cauhinh->gia_dien;
        $tien_nuoc = $so_nuoc * $cauhinh->gia_nuoc;
        $tien_phong = $hopdong->Gia_phong_thuc_te;

        //Tính tiền dịch vụ phát sinh
        $tien_dich_vu_them = 0;
        $dich_vu_duoc_chon = []; //Mảng lưu tên dịch vụ đã chọn để hiển thị trong chi tiết hóa đơn
        if ($request->has('dich_vu')) {
            //Lấy thông tin dịch vụ đã chọn
            $dich_vu_duoc_chon = Dichvu::whereIn('Ma_dich_vu', $request->dich_vu)->get();
            foreach ($dich_vu_duoc_chon as $dv) {
                //Tính tiền dịch vụ phát sinh
                $tien_dich_vu_them += $dv->Don_gia;
            }
        }
        //Tổng tiền phải thanh toán
        $tong_tien = $tien_phong + $tien_dien + $tien_nuoc + $tien_dich_vu_them;
        //lưu hóa đơn
        $hoadon = Hoadon::create([
            'Ma_hop_dong' => $request->Ma_hop_dong,
            'Thang' => $request->Thang,
            'Nam' => $request->Nam,
            'Ngay_lap' => \Carbon\Carbon::now(),
            'Chi_so_dien_cu' => $request->Chi_so_dien_cu,
            'Chi_so_dien_moi' => $request->Chi_so_dien_moi,
            'Chi_so_nuoc_cu' => $request->Chi_so_nuoc_cu,
            'Chi_so_nuoc_moi' => $request->Chi_so_nuoc_moi,
            'Tien_dien' => $tien_dien,
            'Tien_nuoc' => $tien_nuoc,
            'Tien_phong' => $tien_phong,
            'Tong_tien' => $tong_tien,
            'Trang_thai' => 0 //Mặc định khi tạo là chưa thanh toán
        ]);
        //lưu chi tiết hóa đơn cho các dịch vụ phát sinh (nếu có)
        if (count($dich_vu_duoc_chon) > 0) {
            foreach ($dich_vu_duoc_chon as $dv) {
                Chitiethoadon::create([
                    'Ma_hoa_don' => $hoadon->Ma_hoa_don,
                    'Ma_dich_vu' => $dv->Ma_dich_vu,
                    'Chi_so_cu' => 0, //Dịch vụ phát sinh nên không có chỉ số cũ
                    'Chi_so_moi' => 0,
                    'So_luong_su_dung' => 1, //Mặc định mỗi dịch vụ phát sinh được tính 1 đơn vị, có thể tùy chỉnh sau nếu cần
                    'Thanh_tien' => $dv->Don_gia
                ]);
            }
        }
        return redirect()->route('hoadon.index')
            ->with('thongbao', 'Đã lập hóa đơn thành công!');
    }

    //thanh toán hóa đơn
    public function thanhtoan($id)
    {
        //Cập nhật trạng thái thành 1 (Đã thanh toán) bằng query trực tiếp
        $rows = Hoadon::where('Ma_hoa_don', $id)->update(['Trang_thai' => 1]);
        if ($rows > 0) {
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

    //in hóa đơn
    public function print($id)
    {
        //lấy thông tin hóa đơn kèm hợp đồng, phòng, khách
        $hoadon = Hoadon::with(['hopdong.phong', 'hopdong.khach'])->find($id);
        if (!$hoadon) {
            return redirect()->back()
                ->with('error', 'Hóa đơn không tồn tại!');
        }
        //lấy thông tin cấu hình để in tên nhà trọ và giá điện nước
        $cauhinh = \App\Models\Cauhinh::first();
        //Tích hợp thanh toán bằng QR
        $ngan_hang = 'ICB';
        $so_tai_khoan = '105878707711';
        $chu_tai_khoan = 'TRAN MINH DUNG';
        //Tạo nội dung chuyển khoản tự động
        $noi_dung = 'Thanh toan ' . $hoadon->hopdong->phong->Ten_phong . 'Thang' . $hoadon->Thang;
        // Ghép chuỗi tạo URL ảnh QR từ API
        $qr_url = "https://img.vietqr.io/image/{$ngan_hang}-{$so_tai_khoan}-compact2.png?amount={$hoadon->Tong_tien}&addInfo=" . urlencode($noi_dung) . "&accountName=" . urlencode($chu_tai_khoan);

        //Trả về view in hóa đơn
        return view('hoa_don.print', compact('hoadon', 'cauhinh', 'qr_url'));
    }
    //chi tiết hóa đơn
    public function show($id)
    {
        // Lấy hóa đơn kèm theo: Hợp đồng, Phòng, Khách hàng và Các dịch vụ chi tiết
        $hoadon = Hoadon::with(['Hopdong.phong', 'Hopdong.khachhang', 'chitiets.dichvu'])->find($id);
        if (!$hoadon) {
            return redirect()->route('hoadon.index')
                ->with('error', 'Không tìm thấy hóa đơn!');
        }
        //Lấy cấu hình để biết giá điện, giá nước
        $cauhinh = \App\Models\Cauhinh::first();
        return view('hoa_don.show', compact('hoadon', 'cauhinh'));
    }
}
