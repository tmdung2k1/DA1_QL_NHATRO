<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('tieude') - Quản Lý Nhà Trọ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    @stack('css')
    {{-- nếu có css riêng cho từng trang thì thêm vào đây --}}
</head>

<body>
    @include('layout.menu')
    <div class="main-content">
        <div class="navbar-top d-flex justify-content-between align-items-center px-4 py-3 mb-3 shadow-sm rounded-3">
            <h1 class="h2 mb-0 fw-bold">@yield('tieude')</h1>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted small"><i class="bi bi-clock me-1"></i>{{ date('d/m/Y') }}</span>
            </div>
        </div>
        @yield('noidung')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/menu.js') }}"></script>
    @stack('js')
    @php
        $cauhinh = \App\Models\Cauhinh::first();
    @endphp
    <div class="modal fade" id="settingModal" ntabindex = "-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold"><i class="bi bi-gear-fill"></i> Cấu Hình Giá & Thông Tin</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('caidat.update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="fw-bold mb-1">Tên Nhà Trọ / Hệ Thống</label>
                            <input type="text" name="ten_nha_tro"
                                class="form-control"value="{{ $cauhinh->ten_nha_tro ?? 'Nhà Trọ TMD' }}" required>
                        </div>
                        <h6 class="text-primary border-bottom pb-2 mt-4 mb-3">Đơn Giá Dịch Vụ</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold text-warning"><i class="bi bi-lightning-fill"></i> Giá
                                    Điện(VNĐ/kWh)</label>
                                <input type="number" name="gia_dien"
                                    class="form-control"value="{{ $cauhinh->gia_dien ?? 3500 }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold text-info"><i class="bi bi-droplet-fill"></i> Giá
                                    Nước(VNĐ/m³)</label>
                                <input type="number" name="gia_nuoc"
                                    class="form-control"value="{{ $cauhinh->gia_nuoc ?? 10000 }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Lưu Thay Đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
