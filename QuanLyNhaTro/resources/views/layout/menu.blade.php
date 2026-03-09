<div class="sidebar" id="sidebar">
    <div class="d-flex align-items-center justify-content-between px-3 py-3 sidebar-header">
        <a href="/" class="d-flex align-items-center text-decoration-none sidebar-brand">
            <span class="brand-icon">🏠</span>
            <span class="brand-title ms-2">{{ \App\Models\Cauhinh::first()->ten_nha_tro ?? 'Quản Lý Nhà Trọ' }}</span>
        </a>
        {{-- Nút toggle thu gọn menu --}}
        <button class="btn btn-sm btn-light toggle-btn" id="sidebarToggle" title="Thu gọn menu">
            <i class="bi bi-layout-sidebar" id="toggleIcon"></i>
        </button>
    </div>
    <hr class="mx-3 mt-0">
    <ul class="nav nav-pills flex-column mb-auto px-2" id="navMenu" style="position:relative">
        <div id="nav-slider"></div>
        <li class="nav-item">
            {{-- sử dụng cấu trúc routeIs để kiểm tra nếu route hiện tại là 'trangchu' thì thêm class 'active' --}}
            <a href="{{ url('/') }}" class="nav-link {{ request()->routeIs('trangchu') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line menu-icon"></i>
                <span class="menu-text">Tổng quan</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('phong.index') }}" class="nav-link {{ request()->routeIs('phong.*') ? 'active' : '' }}">
                <i class="bi bi-house-door menu-icon"></i>
                <span class="menu-text">Quản lý phòng</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('khachhang.index') }}"
                class="nav-link {{ request()->routeIs('khachhang.*') ? 'active' : '' }}">
                <i class="bi bi-people menu-icon"></i>
                <span class="menu-text">Khách thuê</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('hopdong.index') }}"
                class="nav-link {{ request()->routeIs('hopdong.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text menu-icon"></i>
                <span class="menu-text">Hợp đồng</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('hoadon.index') }}"
                class="nav-link {{ request()->routeIs('hoadon.*') ? 'active' : '' }}">
                <i class="bi bi-receipt menu-icon"></i>
                <span class="menu-text">Hóa đơn</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dichvu.index') }}"
                class="nav-link {{ request()->routeIs('dichvu.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam menu-icon"></i>
                <span class="menu-text">Dịch vụ</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#settingModal">
                <i class="bi bi-gear menu-icon"></i>
                <span class="menu-text">Cài đặt</span>
            </a>
        </li>
    </ul>
    <hr class="mx-3">
    <div class="dropdown px-3 pb-3">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1"
            data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('image/admin.jpg') }}" alt="" width="32" height="32"
                class="rounded-circle me-2 flex-shrink-0">
            <strong class="menu-text">Admin</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a></li>
        </ul>
    </div>
</div>
