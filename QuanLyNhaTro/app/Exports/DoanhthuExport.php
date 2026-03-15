<?php

namespace App\Exports;

use App\Models\Hoadon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DoanhthuExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $stt = 0;
    //Lấy dữ liệu từ database (Chỉ lấy các hóa đơn đã thanh toán)
    public function collection()
    {
        return Hoadon::with('hopdong.phong')
            ->where('Trang_thai', 1) // Lọc chỉ những hóa đơn đã thanh toán
            ->orderBy('Nam', 'desc')
            ->orderBy('Thang', 'desc')
            ->get();
    }
    //Định nghĩa tiêu đề cho các cột trong file Excel
    public function headings(): array
    {
        return [
            'STT',
            'Mã HĐ',
            'Phòng',
            'Kỳ Thu',
            'Tiền Phòng (VNĐ)',
            'Tiền Điện (VNĐ)',
            'Tiền Nước (VNĐ)',
            'Tổng Tiền (VNĐ)',
            'Ngày Lập'
        ];
    }
    //Đổ dữ liệu từng dòng tương ứng với tiêu đề
    public function map($hoadon): array
    {
        $this->stt++; // Tăng số thứ tự cho mỗi dòng
        return [
            $this->stt, // Số thứ tự
            'HD-' . str_pad($hoadon->Ma_hoa_don, 4, '0', STR_PAD_LEFT), // Mã HĐ với định dạng HD-0001
            $hoadon->hopdong->phong->Ten_phong ?? 'Phòng trống',
            'Tháng ' . $hoadon->Thang . '/' . $hoadon->Nam,
            number_format($hoadon->Tien_phong),
            number_format($hoadon->Tien_dien),
            number_format($hoadon->Tien_nuoc),
            number_format($hoadon->Tong_tien),
            \Carbon\Carbon::parse($hoadon->Ngay_lap)->format('d/m/Y') // Định dạng ngày lập theo kiểu ngày/tháng/năm      
        ];
    }
    //Định dạng style cho file Excel 
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]]
        ];
    }
}
