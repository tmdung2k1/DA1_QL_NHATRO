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
                    <tr class="text-center">
                        <th>Mã loại phòng</th>
                        <th>Tên loại phòng</th>
                        <th>Đơn giá (VNĐ)</th>
                        <th>Mô tả</th>
                        <th width="150">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ds_loaiphong as $item)
                        <tr class="text-center">
                            <td>{{ $item->Ma_loai_phong }}</td>
                            <td class="fw-bold">{{ $item->Ten_loai_phong }}</td>
                            <td class="text-success">{{ number_format($item->Don_gia) }}đ</td>
                            <td>{{ $item->Mo_ta }}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm btn-edit-loaiphong"
                                    data-id="{{ $item->Ma_loai_phong }}" data-ten="{{ $item->Ten_loai_phong }}"
                                    data-dongia="{{ $item->Don_gia }}" data-mota="{{ $item->Mo_ta }}">
                                    Sửa
                                </button>
                                <a href="{{ route('loaiphong.destroy', $item->Ma_loai_phong) }}"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa loại phòng này không?');">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Sửa Loại Phòng --}}
    <div class="modal fade" id="editLoaiPhongModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cập Nhật Loại Phòng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditLoaiPhong" method="POST" data-update-url="{{ route('loaiphong.update', ':id') }}">
                        @csrf
                        <div class="mb-3">
                            <label>Tên loại phòng</label>
                            <input type="text" name="Ten_loai_phong" id="edit_Ten_loai_phong" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label>Đơn giá (VNĐ)</label>
                            <input type="number" name="Don_gia" id="edit_Don_gia" class="form-control" min="0"
                                required>
                        </div>
                        <div class="mb-3">
                            <label>Mô tả</label>
                            <textarea name="Mo_ta" id="edit_Mo_ta" class="form-control" rows="3"></textarea>
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

@push('js')
    <script src="{{ asset('js/loaiphong.js') }}"></script>
@endpush
