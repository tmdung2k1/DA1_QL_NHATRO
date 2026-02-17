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
    @stack('js')
</body>

</html>
