@extends('layout.master')
@section('tieude', 'Quản lý Loại Phòng')

@section('noidung')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Danh sách loại phòng</h5>
            <a href="{{ route('loaiphong.create') }}" class = "btn btn-primary">
                <i class="fa fa-plus"></i> Thêm loại phòng mới
            </a>
        </div>
        <div class="card-body">
            @if (@session('thongbao'))
                <div class="alert alert-success">
                    {{ session('thongbao') }}
                </div>
            @endif
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Mã loại phòng</th>
                        <th>Tên loại phòng</th>
                        <th>Đơn giá (VNĐ)</th>
                        <th>Mô tả</th>
                        <th width="150">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ds_loaiphong as $item)
                        <tr>
                            <td>{{ $item->Ma_loai_phong }}</td>
                            <td class="fw-bold">{{ $item->Ten_loai_phong }}</td>
                            <td class="text-success">{{ number_format($item->Don_gia) }}đ</td>
                            <td>{{ $item->Mo_ta }}</td>
                            <td>
                                <a href="{{ route('loaiphong.edit', $item->Ma_loai_phong) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <a href="{{ route('loaiphong.destroy', $item->Ma_loai_phong) }}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa loại phòng này không?');">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
