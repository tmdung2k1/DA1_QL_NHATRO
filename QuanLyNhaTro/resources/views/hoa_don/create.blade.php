@extends('layout.master')
@section('tieude', 'Lập hóa đơn')

@section('noidung')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-3">
            <strong><i class="bi bi-exclamation-triangle-fill"></i> Lỗi nhập liệu:</strong>
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('hoadon.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Chọn Phòng/Hợp đồng</label>
                        <select name="Ma_hop_dong" id="select_hop_dong"
                            class="form-select @error('Ma_hop_dong') is-invalid @enderror" required>
                            <option value="">-- Chọn --</option>
                            @foreach ($ds_hopdong as $hd)
                                <option value="{{ $hd->Ma_hop_dong }}"
                                    {{ old('Ma_hop_dong') == $hd->Ma_hop_dong ? 'selected' : '' }}>
                                    {{ $hd->phong->Ten_phong }} - {{ $hd->khach->Ho_ten }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Tháng</label>
                        <input type="number" name="Thang" min="1" max="12"
                            class="form-control @error('Thang') is-invalid @enderror" value="{{ old('Thang', date('m')) }}"
                            required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Năm</label>
                        <input type="number" name="Nam" class="form-control @error('Nam') is-invalid @enderror"
                            value="{{ old('Nam', date('Y')) }}" required>
                    </div>
                </div>

                <div class="row border-top pt-3">
                    <div class="col-md-6">
                        <h5 class="text-warning">Điện</h5>
                        <div class="mb-2">
                            <label>Chỉ số cũ</label>
                            <input type="number" name="Chi_so_dien_cu" id="dien_cu" class="form-control bg-light"
                                value="{{ old('Chi_so_dien_cu') }}" readonly>
                        </div>
                        <div class="mb-2">
                            <label>Chỉ số mới</label>
                            <input type="number" name="Chi_so_dien_moi"
                                class="form-control @error('Chi_so_dien_moi') is-invalid @enderror"
                                value="{{ old('Chi_so_dien_moi') }}" required>
                            @error('Chi_so_dien_moi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-info">Nước</h5>
                        <div class="mb-2">
                            <label>Chỉ số cũ</label>
                            <input type="number" name="Chi_so_nuoc_cu" id="nuoc_cu" class="form-control bg-light"
                                value="{{ old('Chi_so_nuoc_cu') }}" readonly>
                        </div>
                        <div class="mb-2">
                            <label>Chỉ số mới</label>
                            <input type="number" name="Chi_so_nuoc_moi"
                                class="form-control @error('Chi_so_nuoc_moi') is-invalid @enderror"
                                value="{{ old('Chi_so_nuoc_moi') }}" required>
                            @error('Chi_so_nuoc_moi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <h5 class="mt-4 text-primary border-bottom pb-2"><i class="bi bi-ui-checks-grid"></i> Dịch Vụ Sử Dụng Thêm
                    (Tùy chọn)</h5>
                <div class="row mb-4 mt-3">
                    @foreach ($dichvu as $dv)
                        <div class="col-md-4 mb-2">
                            <div class="form-check border p-2 rounded bg-light shadow-sm">
                                <input type="checkbox" name="dich_vu[]" class="form-check-input fs-5 ms-1"
                                    value="{{ $dv->Ma_dich_vu }}" id="dv_{{ $dv->Ma_dich_vu }}"
                                    {{ in_array($dv->Ma_dich_vu, old('dich_vu', [])) ? 'checked' : '' }}>
                                <label class="form-check-label w-100 ms-2 cursor-pointer" for="dv_{{ $dv->Ma_dich_vu }}">
                                    <strong class="text-dark">{{ $dv->Ten_dich_vu }}</strong>
                                    <br>
                                    <small class="text-danger fw-bold">{{ number_format($dv->Don_gia) }} VNĐ</small>
                                    <small class="text-muted">{{ $dv->Don_vi_tinh }}</small>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-end">
                    <a href="{{ route('hoadon.index') }}" class="btn btn-secondary">Hủy</a>
                    <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Lưu Hóa Đơn</button>
                </div>
            </form>
        </div>
    </div>
    @push('js')
        <script src="{{ asset('js/hoadon.js') }}"></script>
    @endpush
@endsection
