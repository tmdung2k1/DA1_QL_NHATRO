@extends('layout.master')
@section('tieude', 'Dashboard')

@section('noidung')
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 fw-bold text-dark">Tổng Quan Hệ Thống</h4>
                <small class="text-muted">Số liệu tính đến ngày {{ date('d/m/Y') }}</small>
            </div>
            <div class="badge bg-white text-dark p-2 border shadow-sm d-flex align-items-center">
                <i class="bi bi-calendar-event me-2 text-primary"></i>
                <span class="fw-bold">Tháng {{ $thang_nay }}/{{ $nam_nay }}</span>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 border-start border-success border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-uppercase text-muted small fw-bold mb-1">Doanh Thu Tháng</div>
                                <h3 class="text-success fw-bold mb-0">
                                    {{ number_format($doanh_thu) }} <span class="fs-6 text-muted fw-normal">VNĐ</span>
                                </h3>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success">
                                <i class="bi bi-cash-stack fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 border-start border-warning border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-uppercase text-muted small fw-bold mb-1">Phòng Trống</div>
                                <h3 class="text-warning fw-bold mb-0">
                                    {{ $phong_trong }} <span class="fs-6 text-muted fw-normal">/ {{ $tong_phong }}</span>
                                </h3>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded-circle text-warning">
                                <i class="bi bi-house-door fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 border-start border-primary border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-uppercase text-muted small fw-bold mb-1">Tổng Khách</div>
                                <h3 class="text-primary fw-bold mb-0">
                                    {{ $tong_khach }} <span class="fs-6 text-muted fw-normal">Người</span>
                                </h3>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary">
                                <i class="bi bi-people fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 border-start border-danger border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-uppercase text-muted small fw-bold mb-1">Chưa Thanh Toán</div>
                                <h3 class="text-danger fw-bold mb-0">
                                    {{ $hoa_don_chua_thu }} <span class="fs-6 text-muted fw-normal">Hóa đơn</span>
                                </h3>
                            </div>
                            <div class="bg-danger bg-opacity-10 p-3 rounded-circle text-danger">
                                <i class="bi bi-exclamation-triangle fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-8">
                <h6 class="text-primary fw-bold mb-3"><i class="bi bi-lightning-charge"></i> Truy cập nhanh</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="{{ route('hopdong.create') }}"
                            class="btn btn-outline-primary w-100 p-3 h-100 d-flex flex-column align-items-center justify-content-center gap-2 shadow-sm border-2 fw-bold">
                            <i class="bi bi-file-earmark-plus fs-1"></i>
                            <span>Lập Hợp Đồng</span>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('hoadon.create') }}"
                            class="btn btn-outline-success w-100 p-3 h-100 d-flex flex-column align-items-center justify-content-center gap-2 shadow-sm border-2 fw-bold">
                            <i class="bi bi-receipt fs-1"></i>
                            <span>Tính Tiền Phòng</span>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('khachhang.create') }}"
                            class="btn btn-outline-info w-100 p-3 h-100 d-flex flex-column align-items-center justify-content-center gap-2 shadow-sm border-2 fw-bold">
                            <i class="bi bi-person-plus fs-1"></i>
                            <span>Thêm Khách Mới</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="m-0 fw-bold text-secondary"><i class="bi bi-hdd-stack"></i> Trạng thái phòng</h6>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                                <span><i class="bi bi-check-circle-fill text-success me-2"></i>Đang ở</span>
                                <span class="badge bg-success rounded-pill fs-6">{{ $phong_co_khach }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                                <span><i class="bi bi-dash-circle-fill text-warning me-2"></i>Đang trống</span>
                                <span class="badge bg-warning text-dark rounded-pill fs-6">{{ $phong_trong }}</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center py-3 px-4 bg-light fw-bold border-top">
                                <span class="text-dark">Tổng số phòng:</span>
                                <span class="text-primary fs-5">{{ $tong_phong }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
