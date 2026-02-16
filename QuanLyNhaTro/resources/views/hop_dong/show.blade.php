@extends('layout.master')
@section('tieude', 'Chi Tiết Hợp Đồng')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/hopdong.css') }}">
@endpush

@section('noidung')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="m-0">Hợp Đồng Số: {{ $hopdong->Ma_hop_dong }}</h5>
                <a href="{{ route('hopdong.index') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Quay lại danh sách
                </a>
            </div>

            <div class="card-body">
                {{-- Tiêu đề chỉ hiện khi in --}}
                <h3 class="text-center fw-bold print-title">HỢP ĐỒNG THUÊ TRỌ</h3>

                <div
                    class="alert {{ $hopdong->Trang_thai == 1 ? 'alert-success' : 'alert-secondary' }} text-center fw-bold trang-thai-box">
                    TRẠNG THÁI: {{ $hopdong->Trang_thai == 1 ? 'ĐANG CÓ HIỆU LỰC' : 'ĐÃ THANH LÝ' }}
                </div>
                <div class="row">
                    <div class="col-md-6 border-end">
                        <h5 class="text-primary border-bottom pb-2">I. Bên Thuê (Khách Hàng) </h5>
                        <table class="table table-borderless">
                            <tr>
                                <td style="width: 120px" class="fw-bold">Họ và tên:</td>
                                <td>{{ $hopdong->khach->Ho_ten ?? 'Không có thông tin' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">CCCD: </td>
                                <td>{{ $hopdong->khach->Cccd ?? 'Không có thông tin' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Điện thoại: </td>
                                <td>{{ $hopdong->khach->Sdt ?? 'Không có thông tin' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Quê quán:</td>
                                <td>{{ $hopdong->khach->Que_quan ?? 'Không có thông tin' }}</td>
                            </tr>
                        </table>

                        <h5 class="text-primary border-bottom pb-2 mt-3">II. Thông Tin Phòng Thuê</h5>
                        <table class="table table-borderless">
                            <tr>
                                <td style="width: 120px" class="fw-bold">Tên phòng:</td>
                                <td class="fs-5 text-danger fw-bold">
                                    {{ $hopdong->phong->Ten_phong ?? 'Không có thông tin' }}</td>
                            </tr>
                            <tr>
                                <td class = "fw-bold">Loại phòng: </td>
                                <td>{{ $hopdong->phong->loaiphong->Ten_loai_phong ?? 'Không có thông tin' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Giá niêm yết: </td>
                                <td>{{ number_format($hopdong->phong->loaiphong->Don_gia ?? 0) }} VNĐ</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-primary border-bottom pb-2">III. Chi Tiết Thuê</h5>
                        <table class="table table-striped">
                            <tr>
                                <td>Ngày bắt đầu: </td>
                                <td class="fw-bold">{{ date('d-m-Y', strtotime($hopdong->Ngay_bat_dau)) }}</td>
                            </tr>
                            <tr>
                                <td>Ngày kết thúc (Dự kiến): </td>
                                <td class="fw-bold">
                                    {{ $hopdong->Ngay_ket_thuc ? date('d-m-Y', strtotime($hopdong->Ngay_ket_thuc)) : 'Chưa xác định' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Giá thuê thực tế: </td>
                                <td class="fw-bold">{{ number_format($hopdong->Gia_phong_thuc_te) }}VNĐ/tháng</td>
                            </tr>
                            <tr>
                                <td>Tiền đặt cọc: </td>
                                <td class="fw-bold">{{ number_format($hopdong->Tien_coc) }} VNĐ</td>
                            </tr>
                        </table>

                        <div class="card bg-light mt-2">
                            <div class="card-body">
                                <h6 class="card-title fw-bold text-warning">
                                    Chỉ số bàn giao ban đầu
                                </h6>
                                <div class="d-flex justify-content-between mt-2">
                                    <span class="fw-bold">⚡ Chỉ số Điện:</span>
                                    <span class="fw-bold">{{ $hopdong->Chi_so_dien_dau }} (Kwh)</span>
                                </div>
                                <div class="d-flex justify-content-between border-top mt-2 pt-2">
                                    <span class="fw-bold">💧 Chỉ số Nước:</span>
                                    <span class="fw-bold">{{ $hopdong->Chi_so_nuoc_dau }} (Khối)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4 border-top pt-3 no-print"> {{-- ẩn nút nay khi in --}}
                    @if ($hopdong->Trang_thai == 1)
                        <a href="{{ route('hopdong.terminate', $hopdong->Ma_hop_dong) }}" class="btn btn-danger"
                            onclick="return confirm('Bạn có chắc muốn thanh lý hợp đồng này?')">
                            <i class="bi bi-x-circle"></i> Thanh lý hợp đồng
                        </a>
                    @endif
                    <button class="btn btn-secondary" onclick="window.print()">
                        <i class="bi bi-printer"></i> In Hợp Đồng
                    </button>
                </div>

                {{-- Phần chữ ký - chỉ hiện khi in --}}
                <div class="print-footer">
                    <div class="row mt-5 pt-3">
                        <div class="col-6 text-center">
                            <p class="fw-bold">BÊN CHO THUÊ</p>
                            <p class="text-muted">(Ký và ghi rõ họ tên)</p>
                            <div style="height: 100px;"></div>
                            <p>................................</p>
                        </div>
                        <div class="col-6 text-center">
                            <p class="fw-bold">BÊN THUÊ</p>
                            <p class="text-muted">(Ký và ghi rõ họ tên)</p>
                            <div style="height: 100px;"></div>
                            <p>................................</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
