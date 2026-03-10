@extends('layout.master')
@section('tieude', 'Quản lý Dịch vụ')

@section('noidung')
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-end align-items-center">
            <button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#addDichVuModal">
                <i class="bi bi-plus-circle"></i> Thêm Dịch Vụ Mới
            </button>
        </div>
    </div>

    @if (session('thongbao'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i>{{ session('thongbao') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h4 class="text-primary fw-bold m-0"><i class="bi bi-box-seam"></i> Danh sách Dịch Vụ</h4>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-bordered m-0 text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="10%">Mã DV</th>
                                <th width="35%">Tên Dịch Vụ</th>
                                <th width="20%">Đơn Vị Tính</th>
                                <th width="20%">Đơn Giá</th>
                                <th width="15%">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dichvu as $dv)
                                <tr>
                                    <th>#{{ $dv->Ma_dich_vu }}</th>
                                    <th class="text-start fw-bold text-warning">{{ $dv->Ten_dich_vu }}</th>
                                    <th>{{ $dv->Don_vi_tinh }}</th>
                                    <th class="text-success fw-bold text-end">{{ number_format($dv->Don_gia) }} VNĐ</th>
                                    <th>
                                        <a href="{{ route('dichvu.destroy', $dv->Ma_dich_vu) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa dịch vụ này?'); ">
                                            <i class="bi bi-trash"></i> Xóa
                                        </a>
                                    </th>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-muted py-4">
                                        <i class="bi bi-info-circle-fill"></i> Chưa có dịch vụ nào được thêm vào. Vui lòng
                                        thêm dịch vụ mới.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('dich_vu.create')
@endsection
