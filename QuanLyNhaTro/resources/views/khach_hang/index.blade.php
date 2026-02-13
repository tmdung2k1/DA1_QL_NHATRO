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
                    <tr class="text-center">
                        <th>Họ tên</th>
                        <th>CCCD</th>
                        <th>SĐT</th>
                        <th>Quê quán</th>
                        <th>Email</th>
                        <th>Ngày vào</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ds_khach as $k)
                        <tr class="text-center">
                            <td class="fw-bold">{{ $k->Ho_ten }}</td>
                            <td>{{ $k->Cccd }}</td>
                            <td>{{ $k->Sdt }}</td>
                            <td>{{ $k->Que_quan }}</td>
                            <td>{{ $k->Email ?? 'Chưa có' }}</td>
                            <td>{{ date('d-m-Y', strtotime($k->Ngay_vao)) }}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm btn-edit-khach"
                                    data-id="{{ $k->Ma_khach }}" data-hoten="{{ $k->Ho_ten }}"
                                    data-cccd="{{ $k->Cccd }}" data-sdt="{{ $k->Sdt }}"
                                    data-quequan="{{ $k->Que_quan }}" data-email="{{ $k->Email }}"
                                    data-ngayvao="{{ $k->Ngay_vao ? date('Y-m-d', strtotime($k->Ngay_vao)) : '' }}">
                                    Sửa
                                </button>
                                <a href="{{ route('khachhang.destroy', $k->Ma_khach) }}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Xóa khách này?')">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Sửa Khách Hàng --}}
    <div class="modal fade" id="editKhachHangModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cập Nhật Khách Hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditKhach" method="POST" data-update-url="{{ route('khachhang.update', ':id') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Họ và tên<span class="text-danger">*</span></label>
                                <input type="text" name="Ho_ten" id="edit_Ho_ten" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Số CCCD<span class="text-danger">*</span></label>
                                <input type="tel" name="Cccd" id="edit_Cccd" class="form-control" pattern="[0-9]{12}"
                                    minlength="12" maxlength="12" title="Số CCCD phải gồm 12 chữ số" required>
                                <small class="text-muted">số cccd không được trùng với người khác</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Số điện thoại<span class="text-danger">*</span></label>
                                <input type="tel" name="Sdt" id="edit_Sdt" class="form-control" pattern="[0-9]{10}"
                                    minlength="10" maxlength="10" title="Số điện thoại phải gồm 10 chữ số" required>
                                <small class="text-muted">Số điện thoại phải gồm 10 chữ số, không nhập chữ</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" name="Email" id="edit_Email" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Quê quán<span class="text-danger">*</span></label>
                                <input type="text" name="Que_quan" id="edit_Que_quan" class="form-control"
                                    placeholder="Cà Mau, Cần Thơ..." required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Ngày bắt đầu ở</label>
                                <input type="date" name="Ngay_vao" id="edit_Ngay_vao" class="form-control">
                            </div>
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
    <script src="{{ asset('js/khachhang.js') }}"></script>
@endpush
