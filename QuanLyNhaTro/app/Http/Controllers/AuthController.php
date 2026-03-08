<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //hiển thị form đăng nhập
    public function login()
    {
        // Nếu đã đăng nhập, chuyển hướng về trang chủ
        if (Auth::check()) {
            return redirect()->route('trangchu');
        }
        return view('auth.login');
    }
    //xử lý đăng nhập
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập Email',
            'password.required' => 'Vui lòng nhập Mật khẩu',
        ]);
        //kiểm tra thông tin đăng nhập
        $scredentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        //nếu thông tin hợp lệ, đăng nhập và chuyển hướng về trang chủ
        if (Auth::attempt($scredentials)) {
            return redirect()->route('trangchu')
                ->with('thongbao', 'Đăng nhập thành công');
        }
        //nếu thông tin không hợp lệ, quay lại trang đăng nhập với thông báo lỗi
        return back()
            ->with('error', 'Thông tin đăng nhập không chính xác');
    }
    //xử lý đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
