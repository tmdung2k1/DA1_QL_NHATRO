@extends('layout.master')
@section('tieude', 'Thêm Loại Phòng Mới')

@section('noidung')
    <div class="card" style="max-width: 600px; margin: auto;">
        <div class="card-body">
            <form action="{{ route('loaiphong.store') }}" method="POST">
                {{-- csrf dung de bao mat form trong laravel --}}
                @csrf
                <div class="mb-3">
                    <label class="form-label">Tên loại phòng</label>
                    <input type="text" name="Ten_loai_phong" class="form-control" placeholder="Phòng VIP, Phòng thường..."
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Đơn giá(VNĐ)<span class = "text-danger">*</span></label>
                    <input type="number" name="Don_gia" class="form-control" min = "0" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name = "Mo_ta" class="form-control" rows = "3" placeholder="Có máy lạnh, gác lửng..."></textarea>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('loaiphong.index') }}" class="btn btn-secondary">Hủy</a>
                    <button type="submit" class="btn btn-primary">Lưu</button>

                </div>
            </form>
        </div>
    </div>
@endsection
