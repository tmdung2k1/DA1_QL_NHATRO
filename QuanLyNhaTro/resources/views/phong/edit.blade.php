@extends('layout.master')
@section('tieude', 'Cập Nhật Phòng')

@section('noidung')
    <div class="card" style="max-width: 600px; margin: auto;">
        <div class="card-body">
            <form action="{{ route('phong.update', $phong->Ma_phong) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Tên phòng</label>
                    <input type="text" name="Ten_phong" class="form-control" value="{{ $phong->Ten_phong }}" required>
                </div>
                <div class="mb-3">
                    <label>Loại phòng</label>
                    <select name="Ma_loai_phong" class="form-select" required>
                        <option value="">-- Chọn loại phòng --</option>
                        @foreach ($ds_loaiphong as $lp)
                            <option value="{{ $lp->Ma_loai_phong }}">
                                {{-- Kiểm tra: Nếu Mã loại phòng trùng với Mã cũ của phòng thì thêm chữ selected --}}
                                {{ $lp->Ma_loai_phong == $phong->Ma_loai_phong ? '*' : '' }}
                                {{ $lp->Ten_loai_phong }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Trạng thái</label>
                    <select name="Trang_thai" class="form-select">
                        <option value="0" {{ $phong->Trang_thai == 0 ? '*' : '' }}>Phòng Trống</option>
                        <option value="1" {{ $phong->Trang_thai == 1 ? '*' : '' }}>Đang thuê</option>
                        <option value="2" {{ $phong->Trang_thai == 2 ? '*' : '' }}>Bảo trì</option>
                    </select>
                </div>
                <div class="text-end">
                    <a href="{{ route('phong.index') }}" class="btn btn-secondary">Hủy</a>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
@endsection
