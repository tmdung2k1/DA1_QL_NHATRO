@extends('layout.master')
@section('tieude', 'Danh Sách Khách Thuê')

@section('noidung')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="m-0">Danh Sách Khách hàng</h5>
            <a href="{{ route('khachhang.create') }}" class="btn btn-primary">+ Thêm Khách</a>
        </div>
        <div class="card-body">
            @if (session('thongbao'))
                <div class="alert alert-success">{{ session('thongbao') }} </div>
            @endif
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Họ tên</th>
                        <th>CCCD</th>
                        <th>SĐT</th>
                        <th>Quê quán</th>
                        <th>Ngày vào</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ds_khach as $k)
                        <tr>
                            <td class="fw-bold">{{ $k->Ho_ten }}</td>
                            <td>{{ $k->Cccd }}</td>
                            <td>{{ $k->Sdt }}</td>
                            <td>{{ $k->Que_quan }}</td>
                            <td>{{ date('d-m-Y', strtotime($k->Ngay_vao)) }}</td>
                            <td>
                                <a href="{{ route('khachhang.edit', $k->Ma_khach) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <a href="{{ route('khachhang.destroy', $k->Ma_khach) }}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Xóa khách này?')">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
