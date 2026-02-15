@extends('layout.master')
@section('tieude', 'Quản Lý Hợp Đồng')

@section('noidung')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="m-0">Danh sách hợp đồng</h5>
            <a href="{{ route('hopdong.create') }}" class="btn btn-primary">+ Lập Hợp Đồng Mới</a>
        </div>
        <div class="card-body">
            @if (session('thongbao'))
                <div class="alert alert-success">{{ session('thongbao') }}</div>
            @endif
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr class="text-center">
                        <th>Mã HĐ</th>
                        <th>Phòng</th>
                        <th>Khách thuê</th>
                        <th>Ngày bắt đầu</th>
                        <th>Điện/Nước đầu</th>
                        <th>Giá thuê</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ds_hopdong as $hd)
                        <tr class="text-center">
                            <td>{{ $hd->Ma_hop_dong }}</td>
                            <td class="fw-bold text-primary">{{ $hd->phong->Ten_phong ?? 'N/A' }}</td>
                            <td>{{ $hd->khach->Ho_ten ?? 'N/A' }}</td>
                            <td>{{ date('d-m-Y', strtotime($hd->Ngay_bat_dau)) }}</td>
                            <td>
                                ⚡ {{ $hd->Chi_so_dien_dau }} <br>
                                💧 {{ $hd->Chi_so_nuoc_dau }}
                            </td>
                            <td class="text-end">{{ number_format($hd->Gia_phong_thuc_te) }}đ</td>
                            <td>
                                @if ($hd->Trang_thai == 1)
                                    <span class="badge bg-success">Hiệu lực</span>
                                @else
                                    <span class="badge bg-secondary">Đã kết thúc</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('hopdong.show', $hd->Ma_hop_dong) }}" class="btn btn-outline-info btn-sm">
                                        <i class="bi bi-eye"></i> Xem chi tiết
                                    </a>
                                    @if ($hd->Trang_thai == 1)
                                        <a href="{{ route('hopdong.terminate', $hd->Ma_hop_dong) }}"
                                            class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Bạn có chắc muốn thanh lý hợp đồng này?\nPhòng sẽ được chuyển về trạng thái TRỐNG.');">
                                            <i class="bi bi-x-circle"></i> Thanh lý
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
