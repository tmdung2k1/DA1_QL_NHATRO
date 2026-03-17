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
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }} </div>
            @endif
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>Tên Phòng</th>
                        <th>Loại Phòng</th>
                        <th>Giá Cơ Bản</th>
                        <th>Trạng Thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ds_phong as $item)
                        <tr class="text-center">
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
                                <button type="button" class="btn btn-sm btn-warning btn-edit-phong"
                                    data-id="{{ $item->Ma_phong }}" data-ten="{{ $item->Ten_phong }}"
                                    data-loai="{{ $item->Ma_loai_phong }}" data-trangthai="{{ $item->Trang_thai }}">
                                    Sửa
                                </button>
                                <a href="{{ route('phong.destroy', $item->Ma_phong) }}" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Xóa phòng này?')">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="editPhongModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cập Nhật Phòng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditPhong" method="POST" data-update-url="{{ route('phong.update', ':id') }}">
                        @csrf
                        <div class="mb-3">
                            <label>Tên phòng</label>
                            <input type="text" name="Ten_phong" id="edit_Ten_phong" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Loại phòng</label>
                            <select name="Ma_loai_phong" id="edit_Ma_loai_phong" class="form-select" required>
                                @foreach ($ds_loaiphong as $lp)
                                    <option value="{{ $lp->Ma_loai_phong }}">{{ $lp->Ten_loai_phong }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Trạng thái</label>
                            <select name="Trang_thai" id="edit_Trang_thai" class="form-select">
                                <option value="0">Phòng Trống</option>
                                <option value="1">Đang thuê</option>
                                <option value="2">Bảo trì</option>
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-warning">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- goi js --}}
@push('js')
    <script src="{{ asset('js/phong.js') }}"></script>
@endpush
