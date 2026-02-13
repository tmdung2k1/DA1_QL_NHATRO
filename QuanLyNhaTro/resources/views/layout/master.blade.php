<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('tieude') - Quản Lý Nhà Trọ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    @stack('css') 
    {{-- nếu có css riêng cho từng trang thì thêm vào đây --}}
    <style>
        body {
            background-color: #f8f9fa;
        }

        /* Đẩy nội dung sang phải để tránh menu che mất */
        .main-content {
            margin-left: 280px;
            padding: 20px;
        }
    </style>
</head>

<body>
    @include('layout.menu')
    <div class="main-content">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">@yield('tieude')</h1>
        </div>
        @yield('noidung')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('js')
</body>

</html>
