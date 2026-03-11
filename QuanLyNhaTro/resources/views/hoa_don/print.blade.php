<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ 'In Hóa Đơn - ' . $hoadon->hopdong->phong->Ten_phong }}</title>
    <link rel="stylesheet" href="{{ asset('css/print_bill.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="text-center mt-3 mb-3 no-print">
            <button onclick="window.print()" class="btn btn-success btn-lg"><i class="bi bi-printer"></i> Xác Nhận
                In</button>
            <a href="{{ route('hoadon.index') }}" class="btn btn-secondary btn-lg">Quay Lại</a>
        </div>

        <div class="bill-container">
            <div class="row border-bottom pb-3">
                <div class="col-8">
                    <h4 class="fw-bold">{{ $cauhinh->ten_nha_tro ?? 'HỆ THỐNG NHÀ TRỌ' }}</h4>
                    <div>Kỳ thu tiền: Tháng <strong>{{ $hoadon->Thang }} / {{ $hoadon->Nam }}</strong></div>
                    <div>Ngày lập biên lai: {{ date('d/m/Y', strtotime($hoadon->Ngay_lap)) }}</div>
                </div>
                <div class="col-4 text-end">
                    <h5 class="text-danger fw-bold">Mã HĐ: #{{ $hoadon->Ma_hoa_don }}</h5>
                    <div>Trạng thái:
                        @if ($hoadon->Trang_thai == 1)
                            <strong style="white-space: nowrap;">ĐÃ THANH TOÁN</strong>
                        @else
                            <strong style="white-space: nowrap;">CHƯA THANH TOÁN</strong>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bill-title">HÓA ĐƠN TIỀN TRỌ</div>

            <div class="mb-3">
                <div><strong>Thông tin khách hàng:</strong> {{ $hoadon->hopdong->khach->Ho_ten }}</div>
                <div><strong>Phòng thuê:</strong> Phòng {{ $hoadon->hopdong->phong->Ten_phong }}</div>
            </div>

            <table class="table table-bill mb-4">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">STT</th>
                        <th width="35%">Nội dung</th>
                        <th width="20%" class="text-center">Số lượng</th>
                        <th width="15%" class="text-end">Đơn giá</th>
                        <th width="25%" class="text-end">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Tiền thuê phòng tháng {{ $hoadon->Thang }}</td>
                        <td class="text-center">1 Tháng</td>
                        <td class="text-end">{{ number_format($hoadon->Tien_phong) }}</td>
                        <td class="text-end fw-bold">{{ number_format($hoadon->Tien_phong) }}</td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Tiền điện ({{ $hoadon->Chi_so_dien_cu }} -> {{ $hoadon->Chi_so_dien_moi }})</td>
                        <td class="text-center">{{ $hoadon->Chi_so_dien_moi - $hoadon->Chi_so_dien_cu }}kWh</td>
                        <td class="text-end">{{ number_format($cauhinh->gia_dien ?? 0) }}</td>
                        <td class="text-end fw-bold">{{ number_format($hoadon->Tien_dien) }}</td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td>Tiền nước ({{ $hoadon->Chi_so_nuoc_cu }} -> {{ $hoadon->Chi_so_nuoc_moi }})</td>
                        <td class="text-center">{{ $hoadon->Chi_so_nuoc_moi - $hoadon->Chi_so_nuoc_cu }} Khối</td>
                        <td class="text-end">{{ number_format($cauhinh->gia_nuoc ?? 0) }}</td>
                        <td class="text-end fw-bold">{{ number_format($hoadon->Tien_nuoc) }}</td>
                    </tr>
                    @php $stt = 4; @endphp
                    @foreach ($hoadon->chitiets as $chitiet)
                        <tr>
                            <td class="text-center">{{ $stt++ }}</td>
                            <td>{{ $chitiet->dichvu->Ten_dich_vu ?? 'Dịch vụ đã xóa' }}</td>
                            <td class="text-center">{{ $chitiet->So_luong_su_dung }}
                                {{ $chitiet->dichvu->Don_vi_tinh ?? 'Lần' }}</td>
                            <td class="text-end">{{ number_format($chitiet->Thanh_tien) }}</td>
                            <td class="text-end fw-bold">
                                {{ number_format($chitiet->Thanh_tien * $chitiet->So_luong_su_dung) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-end fw-bold fs-5">TỔNG CỘNG:</td>
                        <td class="text-end fw-bold fs-5 text-danger">{{ number_format($hoadon->Tong_tien) }} VNĐ</td>
                    </tr>
                </tbody>
            </table>

            <div class="row mt-5 text-center">
                <div class="col-6">
                    <strong>Người lập biên lai</strong>
                    <br>
                    <small>(Ký, ghi rõ họ tên)</small>
                    <br><br><br><br><span>...................................</span>
                </div>
                <div class="col-6">
                    <strong>Khách hàng</strong>
                    <br>
                    <small>(Ký, ghi rõ họ tên)</small>
                    <br><br><br><br><span>...................................</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
