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
    <div class="login-box">
        <div class="login-logo">
            <i class="bi bi-house-door-fill"></i> QUẢN LÝ NHÀ TRỌ
        </div>

        @if (session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Email đăng nhập</label>
                <input type="email" name="email" class="form-control" placeholder="Nhập email..." required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu..." required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100 fw-bold fs-5 py-2">ĐĂNG NHẬP</button>
        </form>
        <div class="text-center mt-3 text-muted small">
            &copy; {{ date('Y') }} Quản Lý Nhà Trọ. Trần Minh Dững - Cần Thơ
        </div>
    </div>
</body>

</html>
