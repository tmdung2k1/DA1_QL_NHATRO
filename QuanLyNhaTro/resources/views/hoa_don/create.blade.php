@extends('layout.master')
@section('tieude', 'Lập hóa đơn')

@section('noidung')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('hoadon.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Chọn Phòng/Hợp đồng</label>
                        <select name="Ma_hop_dong" id="select_hop_dong" class="form-select" required>
                            <option value="">-- Chọn --</option>
                            @foreach ($ds_hopdong as $hd)
                                <option value="{{ $hd->Ma_hop_dong }}">{{ $hd->phong->Ten_phong }} -
                                    {{ $hd->khach->Ho_ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Tháng</label>
                        <input type="number" name="Thang" min="1" max="12" class="form-control"
                            value="{{ date('m') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Năm</label>
                        <input type="number" name="Nam" class="form-control" value="{{ date('Y') }}" required>
                    </div>
                </div>

                <div class="row border-top pt-3">
                    <div class="col-md-6">
                        <h5 class="text-warning">Điện</h5>
                        <div class="mb-2">
                            <label>Chỉ số cũ</label>
                            <input type="number" name="Chi_so_dien_cu" id="dien_cu" class="form-control bg-light"
                                readonly>
                        </div>
                        <div class="mb-2">
                            <label>Chỉ số mới</label>
                            <input type="number" name="Chi_so_dien_moi" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-info">Nước</h5>
                        <div class="mb-2">
                            <label>Chỉ số cũ</label>
                            <input type="number" name="Chi_so_nuoc_cu" id="nuoc_cu" class="form-control bg-light"
                                readonly>
                        </div>
                        <div class="mb-2">
                            <label>Chỉ số mới</label>
                            <input type="number" name="Chi_so_nuoc_moi" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">Tính Tiền & Lưu</button>
                </div>
            </form>
        </div>
    </div>
    @push('js')
        <script src="{{ asset('js/hoadon.js') }}"></script>
    @endpush
@endsection
