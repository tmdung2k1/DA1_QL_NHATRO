@extends('layout.master')
@section('tieude', 'Lập Hợp Đồng Mới')

@section('noidung')
    <div class="card">
        <div class="card-header">Điền thông tin hợp đồng</div>
        <div class="card-body">
            <form action="{{ route('hopdong.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary border-bottom pb-2">1. Thông tin Phòng & Khách</h6>
                        <div class="mb-3 mt-3">
                            <label class="fw-bold">Chọn Phòng Trống<span class="text-danger">*</span></label>
                            <select name="Ma_phong" class="form-select" required>
                                <option value="">-- Chọn phòng --</option>
                                @foreach ($phong_trong as $p)
                                    <option value="{{ $p->Ma_phong }}">
                                        {{ $p->Ten_phong }} - Giá niêm yết: {{ number_format($p->loaiphong->Don_gia) }}đ
                                    </option>
                                @endforeach
                            </select>
                            @if ($phong_trong->count() == 0)
                                <small class="text-danger">Hiện tại không còn phòng trống nào!</small>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Chọn Khách Thuê<span class="text-danger">*</span></label>
                            <select name="Ma_khach" class="form-select" required>
                                <option value="">-- Chọn khách hàng --</option>
                                @foreach ($ds_khach as $k)
                                    <option value="{{ $k->Ma_khach }}">
                                        {{ $k->Ho_ten }} (CCCD: {{ $k->Cccd }})
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Chưa có tên khách?
                                <a href="{{ route('khachhang.create') }}" target="_blank">Thêm tại đây</a>
                            </small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6 class="text-primary border-bottom pb-2">2. Thời gian & Chi phí</h6>
                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <label>Ngày bắt đầu<span class="text-danger">*</span></label>
                                <input type="date" name = "Ngay_bat_dau" class="form-control" value="{{ date('Y-m-d') }}"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Ngày kết thúc (Dự kiến)</label>
                                <input type="date" name="Ngay_ket_thuc" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Giá phòng thực tế (VNĐ/tháng)<span class="text-danger">*</span></label>
                            <input type="number" name="Gia_phong_thuc_te" class="form-control"
                                placeholder="Nhập giá thuê thỏa thuận" required>
                        </div>
                        <div class="mb-3">
                            <label>Tiền đặt cọc (VNĐ)</label>
                            <input type="number" name="Tien_coc" class="form-control" placeholder="0"
                                onfocus="if(this.value==='0') this.value='';"{{-- Nếu giá trị đang là 0 → ô sẽ tự xóa trắng  --}}
                                onblur="if(this.value==='') this.value='0';" value="0"> {{-- Nếu bạn click ra ngoài mà ô trống → tự động điền lại 0 --}}
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold text-warning">Điện bàn giao (kWh)</label>
                                <input type="number" name="Chi_so_dien_dau" class="form-control" value="0"
                                    onfocus="if(this.value==='0') this.value='';"
                                    onblur="if(this.value==='') this.value='0';" value="0" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold text-primary">Nước bàn giao (m³)</label>
                                <input type="number" name="Chi_so_nuoc_dau" class="form-control" value="0"
                                    onfocus="if(this.value==='0') this.value='';"
                                    onblur="if(this.value==='') this.value='0';" required>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('hopdong.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
                    <button type = "submit" class="btn btn-success btn-lg">✔ Xác nhận lập hợp đồng</button>
                </div>
            </form>
        </div>
    </div>
@endsection
