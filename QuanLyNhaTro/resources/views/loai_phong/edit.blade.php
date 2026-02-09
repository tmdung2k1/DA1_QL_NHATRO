@extends('layout.master')
@section('tieude', 'Cập Nhật Loại Phòng')

@section('noidung')
    <div class="card" style="max-width: 600px; margin: auto;">
        <div class="card-body">
            <form action="{{ route('loaiphong.update', $loaiphong->Ma_loai_phong) }}" method="POST">
                {{-- csrf dung de bao mat form trong laravel --}}
                @csrf
                <div class="mb-3">
                    <label class="form-label">Tên loại phòng</label>
                    <input type="text" name="Ten_loai_phong" class="form-control" value = "{{ $loaiphong->Ten_loai_phong }}"
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Đơn giá(VNĐ)<span class = "text-danger">*</span></label>
                    <input type="number" name="Don_gia" class="form-control" min = "0"
                        value = "{{ $loaiphong->Don_gia }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name = "Mo_ta" class="form-control" rows = "3">{{ $loaiphong->Mo_ta }}</textarea>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('loaiphong.index') }}" class="btn btn-secondary">Hủy</a>
                    <button type="submit" class="btn btn-success">Cập nhật</button>

                </div>
            </form>
        </div>
    </div>
@endsection
