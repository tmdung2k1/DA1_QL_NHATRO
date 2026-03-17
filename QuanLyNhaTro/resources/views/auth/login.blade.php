<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>🏠Đăng Nhập - Quản Lý Nhà Trọ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="login-card">
        <div class="logo-box">
            <i class="bi bi-building"></i>
        </div>

        <div class="delay-1">
            {{-- Hiển thị sau 1s --}}
            <h2 class="login-title">Chào mừng trở lại!</h2>
            <div class="login-subtitle">Hệ thống quản lý nhà trọ</div>
        </div>

        @if (session('error'))
            <div class="alert alert-danger p-2 text-center shadow-sm delay-2"
                style="font-size: 13px, border-radius: 8px;">
                <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3 delay-2">
                <label class="form-label">Email</label>
                <div class="position-relative">
                    <i class="bi bi-person input-icon"></i>
                    <input type="email" name="email" class="form-control" placeholder="Nhập email..."
                        value="{{ old('email') }}" required>
                </div>
            </div>
            <div class="mb-3 delay-3">
                <label class="form-label">Mật khẩu</label>
                <div class="position-relative">
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu..." required>
                </div>
            </div>
            <div class="form-check d-flex align-items-center delay-4">
                <input type="checkbox" class="form-check-input me-2 mt-0" id="remember" style="cursor: pointer">
                <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
            </div>
            <div class="delay-5">
                <button type="submit" class="btn btn-login">ĐĂNG NHẬP NGAY</button>
            </div>
        </form>
    </div>
</body>

</html>
