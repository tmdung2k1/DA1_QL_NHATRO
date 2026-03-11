@extends('layout.master')
@section('tieude', 'Thêm Khách Hàng Mới')

@section('noidung')
    <div class="card" style="max-width: 800px; margin: auto;">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('khachhang.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Họ và tên<span class="text-danger">*</span></label>
                        <input type="text" name="Ho_ten" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Số CCCD<span class="text-danger">*</span></label>
                        <input type="tel" name="Cccd" class="form-control" pattern="[0-9]{12}" minlength="12"
                            maxlength="12" title="Số CCCD phải gồm 12 chữ số" required>
                        <small class="text-muted">số cccd không được trùng với người khác</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Số điện thoại<span class="text-danger">*</span></label>
                        <input type="tel" name="Sdt" class="form-control" pattern="[0-9]{10}" minlength="10"
                            maxlength="10" title="Số điện thoại phải gồm đúng 10 chữ số" required>
                        <small class="text-muted">Số điện thoại phải gồm 10 chữ số, không nhập chữ</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="Email" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Quê quán<span class="text-danger">*</span></label>
                        <input type="text" name="Que_quan" class="form-control" placeholder="Cà Mau, Cần Thơ..."
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Ngày bắt đầu ở</label>
                        <input type="text" name="Ngay_vao" id="create_Ngay_vao" class="form-control" autocomplete="off"
                            data-default="{{ date('Y-m-d') }}" data-max="{{ date('Y-m-d', strtotime('+1 month')) }}">
                    </div>
                    <div class="text-end mt-3">
                        <a href="{{ route('khachhang.index') }}" class="btn btn-secondary">Hủy</a>
                        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/vn.js"></script>
    <script src="{{ asset('js/khachhang.js') }}"></script>
@endpush
