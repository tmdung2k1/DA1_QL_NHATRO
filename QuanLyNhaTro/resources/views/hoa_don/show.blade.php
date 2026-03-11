@extends('layout.master')
@section('tieude', 'Chi tiết hóa đơn')

@section('noidung')
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4 class="text-primary fw-bold m-0"><i class="bi bi-receipt-cutoff"></i> Chi Tiết Hóa Đơn
                #{{ $hoadon->Ma_hoa_don }}</h4>
            <div>
                <a href="{{ route('hoadon.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Quay Lại</a>
            </div>
        </div>
    </div>

    <div class="card shadow border-0">
        <div class="card-body p-4">
            <div class="row mb-4 border-bottom pb-3">
                <div class="col-sm-6">
                    <h6 class="text-muted mb-1">Thông tin khách hàng:</h6>
                    <h5 class="fw-bold text-dark">{{ $hoadon->hopdong->khachhang->Ho_ten }}</h5>
                    <div><strong>Phòng:</strong>{{ $hoadon->hopdong->phong->Ten_phong }}</div>
                    <div><strong>SĐT:</strong>{{ $hoadon->hopdong->khachhang->So_dien_thoai }}</div>
                </div>
                <div class="col-sm-6 text-sm-end">
                    <h6 class="text-muted mb-1">Thông tin hóa đơn:</h6>
                    <div><strong>Kỳ thu tiền:</strong>Tháng {{ $hoadon->Thang }} / {{ $hoadon->Nam }}</div>
                    <div><strong>Ngày lập:</strong> {{ \Carbon\Carbon::parse($hoadon->Ngay_lap)->format('d/m/Y') }}</div>
                    <div><strong>Trạng thái:</strong>
                        @if ($hoadon->Trang_thai == 1)
                            <span class="badge bg-success">Đã thanh toán</span>
                        @else
                            <span class="badge bg-danger">Chưa thanh toán</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th width="5%">STT</th>
                            <th width="40%">Nội Dung Khoản Thu</th>
                            <th width="15%">Số Lượng</th>
                            <th width="15%">Đơn Giá</th>
                            <th width="25%">Thành Tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-center">1</th>
                            <th>Tiền thuê phòng tháng {{ $hoadon->Thang }} / {{ $hoadon->Nam }}</th>
                            <th class="text-center">1 Tháng</th>
                            <th class="text-end text-muted">{{ number_format($hoadon->Tien_phong) }} đ</th>
                            <th class="text-end fw-bold">{{ number_format($hoadon->Tien_phong) }} đ</th>
                        </tr>

                        <tr>
                            <td class="text-center">2</td>
                            <td>Tiền điện sinh hoạt<br><small class="text-muted">(Chỉ số: {{ $hoadon->Chi_so_dien_cu }} ->
                                    {{ $hoadon->Chi_so_dien_moi }})</small></td>
                            <td class="text-center">{{ $hoadon->Chi_so_dien_moi - $hoadon->Chi_so_dien_cu }}</td>
                            <td class="text-end text-muted">{{ number_format($cauhinh->gia_dien) }} đ</td>
                            <td class="text-end fw-bold">{{ number_format($hoadon->Tien_dien) }} đ</td>
                        </tr>

                        <tr>
                            <td class="text-center">3</td>
                            <td>Tiền nước sinh hoạt <br><small class="text-muted">(Chỉ số: {{ $hoadon->Chi_so_nuoc_cu }} ->
                                    {{ $hoadon->Chi_so_nuoc_moi }})</small></td>
                            <td class="text-center">{{ $hoadon->Chi_so_nuoc_moi - $hoadon->Chi_so_nuoc_cu }} Khối</td>
                            <td class="text-end text-muted">{{ number_format($cauhinh->gia_nuoc) }} đ</td>
                            <td class="text-end fw-bold">{{ number_format($hoadon->Tien_nuoc) }} đ</td>
                        </tr>

                        @php
                            $stt = 4; // Biến đếm số thứ tự cho các khoản thu phát sinh
                        @endphp
                        @foreach ($hoadon->chitiets as $chitiet)
                            <tr>
                                <td class="text-center">{{ $stt++ }}</td>
                                <td>Dịch vụ:{{ $chitiet->dichvu->Ten_dich_vu ?? 'Dịch vụ đã xóa' }}</td>
                                <td class="text-center">{{ $chitiet->So_luong_su_dung }}
                                    {{ $chitiet->dichvu->Don_vi_tinh ?? 'Lần' }}</td>
                                <td class="text-end text-muted">{{ number_format($chitiet->Thanh_tien) }} đ</td>
                                <td class="text-end fw-bold">
                                    {{ number_format($chitiet->Thanh_tien * $chitiet->So_luong_su_dung) }} đ</td>
                            </tr>
                        @endforeach

                        <tr class="table-primary">
                            <td colspan="4" class="text-end fw-bold fs-5">TỔNG CỘNG PHẢI THANH TOÁN:</td>
                            <td class="text-end fw-bold fs-5 text-danger">{{ number_format($hoadon->Tong_tien) }} đ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
