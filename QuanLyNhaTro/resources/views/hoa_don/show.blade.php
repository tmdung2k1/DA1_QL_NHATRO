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

    <div class="row mb-5">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="card shadow-sm border-0 h-100 border-start border-primary border-4"
                style="background-color: #eef4ff;">
                <div class="card-body p-4">
                    <h6 class="text-uppercase text-primary fw-bold mb-3"><i class="bi bi-person-badge fs-5 me-1"></i> Thông
                        Tin Khách Hàng</h6>
                    <h4 class="fw-bold text-primary text-uppercase mb-3">{{ $hoadon->hopdong->khachhang->Ho_ten }}</h4>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-door-open fs-5 text-primary me-3"></i>
                        <span class="fs-6"><strong>Phòng thuê:</strong> Phòng
                            {{ $hoadon->hopdong->phong->Ten_phong }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-telephone fs-5 text-primary me-3"></i>
                        <span class="fs-6"><strong>Số điện thoại:</strong>
                            {{ $hoadon->hopdong->khachhang->Sdt ?? 'Chưa cập nhật' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100 border-start border-success border-4"
                style="background-color: #edfaf3;">
                <div class="card-body p-4">
                    <h6 class="text-uppercase text-success fw-bold mb-3"><i class="bi bi-file-earmark-text fs-5 me-1"></i>
                        Thông Tin Hóa Đơn</h6>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-calendar-check fs-5 text-success me-3"></i>
                        <span class="fs-6"><strong>Kỳ thu tiền:</strong> Tháng <span
                                class="fw-bold fs-5 text-dark">{{ $hoadon->Thang }} / {{ $hoadon->Nam }}</span></span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-clock-history fs-5 text-success me-3"></i>
                        <span class="fs-6"><strong>Ngày lập phiếu:</strong>
                            {{ \Carbon\Carbon::parse($hoadon->Ngay_lap)->format('d/m/Y') }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-info-circle fs-5 text-success me-3"></i>
                        <span class="fs-6 me-2"><strong>Trạng thái:</strong></span>
                        @if ($hoadon->Trang_thai == 1)
                            <span class="badge bg-success rounded-pill px-3 py-2 shadow-sm fs-6"><i
                                    class="bi bi-check-circle me-1"></i> Đã thanh toán</span>
                        @else
                            <span class="badge bg-danger rounded-pill px-3 py-2 shadow-sm fs-6"><i
                                    class="bi bi-x-circle me-1"></i> Chưa thanh toán</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow border-0 border-top border-primary border-3">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="text-center text-white" style="background-color: #0d6efd;">
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

                        <tr class="border-0">
                            <td colspan="4" class="text-start fw-bold fs-5 text-black border-0">TỔNG CỘNG PHẢI THANH TOÁN:</td>
                            <td class="text-end fw-bold fs-5 text-black border-0">{{ number_format($hoadon->Tong_tien) }} đ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
