@extends('layout.master')
@section('tieude', 'Danh Sách Hóa Đơn')

@section('noidung')
    <div class="d-flex justify-content-end mb-3 gap-2">
        <a href="{{ route('hoadon.create') }}" class="btn btn-outline-primary fw-bold">+ Lập Hóa Đơn Mới</a>
    </div>
    @if (session('thongbao'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i> {{ session('thongbao') }}
        </div>
    @endif
    <div class="row g-4">
        @foreach ($ds_hoadon as $hd)
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card border-2 h-100 shadow-sm {{ $hd->Trang_thai == 0 ? 'border-warning' : 'border-info' }}">
                    <div
                        class="card-header d-flex justify-content-between align-items-center
                        {{ $hd->Trang_thai == 0 ? 'bg-warning text-dark' : 'bg-info text-white' }} py-2">
                        <span class="fw-bold fs-6"><i class="bi bi-receipt"></i> HÓA ĐƠN #{{ $hd->Ma_hoa_don }}</span>
                        @if ($hd->Trang_thai == 0)
                            <span class="badge bg-white text-warning fw-bold">Chưa thu</span>
                        @else
                            <span class="badge bg-white text-info fw-bold">Đã thu</span>
                        @endif
                    </div>

                    <div class="card-body p-3">
                        {{-- Thông tin phòng & khách --}}
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <div class="fw-bold text-primary fs-5">{{ $hd->hopdong->phong->Ten_phong }}</div>
                                <div class="text-muted" style="font-size:0.9em;">
                                    <i class="bi bi-person-fill"></i> {{ $hd->hopdong->khach->Ho_ten }}
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="badge bg-secondary fs-6">Tháng {{ $hd->Thang }}/{{ $hd->Nam }}</div>
                            </div>
                        </div>
                        <hr class="my-2">
                        {{-- Chi tiết hóa đơn --}}
                        <table class="table table-sm mb-2" style="font-size:0.88em;">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0">🏠 Tiền phòng</td>
                                    <td class="text-end fw-bold">{{ number_format($hd->Tien_phong) }} đ</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">
                                        ⚡ Điện
                                        <small class="text-secondary">
                                            ({{ $hd->Chi_so_dien_cu }} → {{ $hd->Chi_so_dien_moi }}
                                            = <span class="text-danger">{{ $hd->Chi_so_dien_moi - $hd->Chi_so_dien_cu }}
                                                kWh</span>)
                                        </small>
                                    </td>
                                    <td class="text-end fw-bold">{{ number_format($hd->Tien_dien) }} đ</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">
                                        💧 Nước
                                        <small class="text-secondary">
                                            ({{ $hd->Chi_so_nuoc_cu }} → {{ $hd->Chi_so_nuoc_moi }}
                                            = <span class="text-primary">{{ $hd->Chi_so_nuoc_moi - $hd->Chi_so_nuoc_cu }}
                                                m³</span>)
                                        </small>
                                    </td>
                                    <td class="text-end fw-bold">{{ number_format($hd->Tien_nuoc) }} đ</td>
                                </tr>
                            </tbody>
                        </table>
                        <hr class="my-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-uppercase text-muted" style="font-size:0.85em;">Tổng cộng</span>
                            <span class="fw-bold text-danger fs-5">{{ number_format($hd->Tong_tien) }} đ</span>
                        </div>
                    </div>
                    <div class="card-footer bg-light d-flex gap-2 justify-content-end py-2">
                        <a href="{{ route('hoadon.print', $hd->Ma_hoa_don) }}" class="btn btn-outline-secondary"
                            target="_blank">
                            <i class="bi bi-printer"></i> In
                        </a>
                        @if ($hd->Trang_thai == 0)
                            <a href="{{ route('hoadon.thanhtoan', $hd->Ma_hoa_don) }}" class="btn btn-success btn-sm"
                                onclick="return confirm('Xác nhận khách đã đóng đủ {{ number_format($hd->Tong_tien) }} VNĐ?');">
                                <i class="bi bi-currency-dollar"></i> Thu Tiền
                            </a>
                            <a href="{{ route('hoadon.destroy', $hd->Ma_hoa_don) }}" class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn chắc chắn muốn xóa hóa đơn này?');">
                                <i class="bi bi-trash"></i> Xóa
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
