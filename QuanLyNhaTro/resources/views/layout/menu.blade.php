<div class="d-flex flex-column flex-shrink-0 p-3 sidebar">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
        <span class="fs-4 brand-title">🏠 Nhà Trọ TMD</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link active" aria-current="page">
                <i class="bi bi-bar-chart-line me-2"></i>Tổng quan
            </a>
        </li>
        <li>
            <a href="#" class="nav-link">
                <i class="bi bi-house-door me-2"></i>Quản lý phòng
            </a>
        </li>
        <li>
            <a href="#" class="nav-link">
                <i class="bi bi-people me-2"></i>Khách thuê
            </a>
        </li>
        <li>
            <a href="#" class="nav-link">
                <i class="bi bi-file-earmark-text me-2"></i>Hợp đồng
            </a>
        </li>
        <li>
            <a href="#" class="nav-link">
                <i class="bi bi-receipt me-2"></i>Hóa đơn
            </a>
        </li>
        <li>
            <a href="#" class="nav-link">
                <i class="bi bi-gear me-2"></i>Cài đặt
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1"
            data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                class="rounded-circle me-2">
            <strong>Admin</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">Hồ sơ</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Đăng xuất</a></li>
        </ul>
    </div>
</div>
