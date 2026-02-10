@extends('layout.master')
@section('tieude', 'Thêm Phòng Mới')

@section('noidung')
    <div class="card" style="max-width: 600px; margin: auto;">
        <div class="card-body">
            <form action="{{ route('phong.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Tên phòng (Số phòng)</label>
                    <input type="text" name = "Ten_phong" class="form-control" placeholder="P1, P2..." required>
                </div>
                <div class="mb-3">
                    <label>Loại phòng</label>
                    <select name="Ma_loai_phong" class="form-select" required>
                        <option value="">-- Chọn loại phòng --</option>
                        @foreach ($ds_loaiphong as $lp)
                            <option value="{{ $lp->Ma_loai_phong }}">
                                {{ $lp->Ten_loai_phong }} - {{ number_format($lp->Don_gia) }}đ
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Trạng thái</label>
                    <select name="Trang_thai" class="form-select">
                        <option value="0">Phòng Trống</option>
                        <option value="2">Đang sửa chữa / Bảo trì</option>
                    </select>
                </div>
                <div class="text-end">
                    <a href="{{ route('phong.index') }}" class="btn btn-secondary">Hủy</a>
                    <button type="submit" class="btn btn-success">Lưu lại</button>
                </div>
            </form>
        </div>
    </div>
@endsection
