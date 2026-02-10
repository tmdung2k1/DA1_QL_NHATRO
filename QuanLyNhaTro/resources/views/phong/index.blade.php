@extends('layout.master')
@section('tieude', 'Danh Sách Phòng Trọ')

@section('noidung')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="m-0">Quản lý Phòng</h5>
            <a href="{{ route('phong.create') }}" class="btn btn-primary">+ Thêm Phòng</a>
        </div>
        <div class="card-body">
        @if (session('thongbao'))
            <div class="alert alert-success">{{ session('thongbao') }} </div>
        @endif
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Tên Phòng</th>
                    <th>Loại Phòng</th>
                    <th>Giá Cơ Bản</th>
                    <th>Trạng Thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ds_phong as $item)
                    <tr>
                        <td class="fw-bold text-primary">{{ $item->Ten_phong }}</td>
                        <td>{{ $item->loaiphong->Ten_loai_phong ?? 'Chưa phân loại' }}</td>
                        <td>{{ number_format($item->loaiphong->Don_gia ?? 0) }}đ</td>
                        <td>
                            @if ($item->Trang_thai == 0)
                                <span class="badge bg-success">Trống</span>
                            @elseif($item->Trang_thai == 1)
                                <span class="badge bg-danger">Đang thuê</span>
                            @else
                                <span class="badge bg-warning text-dark">Bảo trì</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('phong.edit', $item->Ma_phong) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <a href="{{ route('phong.destroy', $item->Ma_phong) }}"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Xóa phòng này?')">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection