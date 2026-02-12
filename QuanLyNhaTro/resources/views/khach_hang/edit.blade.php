@extends('layout.master')
@section('tieude', 'Cập Nhật Khách Hàng')

@section('noidung')
    <div class="card" style="max-width: 600px; margin: auto;">
        <div class="card-body">
            <form action="{{ route('khachhang.update', $khach->Ma_khach) }}" method="POST">
                {{-- csrf dung de bao mat form trong laravel --}}
                @csrf
                <div class="mb-3">
                    <label class="form-label">Họ và tên<span class="text-danger">*</span></label>
                    <input type="text" name="Ho_ten" class="form-control" value="{{ $khach->Ho_ten }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">CCCD<span class="text-danger">*</span></label>
                    <input type="text" name="Cccd" class="form-control" value="{{ $khach->Cccd }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Số điện thoại<span class="text-danger">*</span></label>
                    <input type="text" name="Sdt" class="form-control" value="{{ $khach->Sdt }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Quê quán<span class="text-danger">*</span></label>
                    <input type="text" name="Que_quan" class="form-control" value="{{ $khach->Que_quan }}" required>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('khachhang.index') }}" class="btn btn-secondary">Hủy</a>
                    <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
@endsection
