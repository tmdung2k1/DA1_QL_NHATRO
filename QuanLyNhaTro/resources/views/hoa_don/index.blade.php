@extends('layout.master')
@section('tieude', 'Danh Sách Hóa Đơn')

@section('noidung')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('hoadon.create') }}" class="btn btn-outline-primary fw-bold">+ Lập Hóa Đơn Mới</a>
    </div>
    <div class="card-shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="m-0">📋 Quản Lý Thu Tiền</h5>
        </div>
        <div class="card-body">
            @if (session('thongbao'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i> {{ session('thongbao') }}
                </div>
            @endif

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>Mã HĐ</th>
                        <th>Phòng / Khách Hàng</th>
                        <th>Kỳ Thu</th>
                        <th>Chi tiết Điện / Nước</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ds_hoadon as $hd)
                        <tr>
                            <td class="text-center">{{ $hd->Ma_hoa_don }}</td>
                            <td>
                                <div class="fw-bold text-primary">{{ $hd->hopdong->phong->Ten_phong }}</div>
                                <small class="text-muted">Khách: {{ $hd->hopdong->khach->Ho_ten }}</small>
                            </td>
                            <td class="text-center">
                                Tháng<b>{{ $hd->Thang }}/{{ $hd->Nam }}</b>
                            </td>
                            <td style="font-size: 0.9em;">
                                <div>⚡ Điện: {{ $hd->Chi_so_dien_cu }} -> <b>{{ $hd->Chi_so_dien_moi }}</b><span
                                        class="text-danger">({{ $hd->Chi_so_dien_moi - $hd->Chi_so_dien_cu }} kWh)</span>
                                </div>
                                <div>💧 Nước: {{ $hd->Chi_so_nuoc_cu }} -> <b>{{ $hd->Chi_so_nuoc_moi }}</b><span
                                        class="text-primary">({{ $hd->Chi_so_nuoc_moi - $hd->Chi_so_nuoc_cu }} m³)</span>
                                </div>
                            </td>
                            <td class="text-end fw-bold text-danger fs-5">
                                {{ number_format($hd->Tong_tien) }} đ
                            </td>
                            <td class="text-center">
                                @if ($hd->Trang_thai == 0)
                                    <span class="badge bg-danger">Chưa thu</span>
                                @else
                                    <span class="badge bg-success">Đã thu</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($hd->Trang_thai == 0)
                                    <a href="{{ route('hoadon.thanhtoan', $hd->Ma_hoa_don) }}"
                                        class="btn btn-outline-success btn-sm"
                                        onclick="return confirm('Xác nhận khách đã đóng đủ {{ number_format($hd->Tong_tien) }} VNĐ?');">
                                        <i class="bi bi-currency-dollar"></i> Thu Tiền
                                    </a>
                                    <a href="{{ route('hoadon.destroy', $hd->Ma_hoa_don) }}"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Bạn chắc chắn muốn xóa hóa đơn này?');">
                                        <i class="bi bi-trash"></i> Xóa
                                    </a>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>✅ Đã thu</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
