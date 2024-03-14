<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    function formLogin()
    {
        return view('web.auth.login');
    }
    function formRegister()
    {
        return view('web.auth.register');
    }
    public function checkLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Nếu đăng nhập thành công
            if (Auth::user()->is_admin == 0) {
                // Nếu người dùng không phải là admin, chuyển hướng đến trang chính
                return redirect('/');
            } else {
                // Nếu người dùng là admin, đăng xuất và chuyển hướng đến trang đăng nhập với thông báo lỗi
                Auth::logout();
                return redirect()->route('web.login')->with('error', 'Admin không đăng nhập được vào đây');
            }
        }
        // Nếu đăng nhập thất bại, chuyển hướng đến trang đăng nhập với thông báo lỗi
        return redirect()->route('web.login')->with('error', 'Đăng nhập thất bại');
    }

    function checkLogout()
    {
        Auth::logout();
        return redirect()->route('web.login');
    }
    function CheckRegister(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email', // Chỉnh sửa để sử dụng 'users' thay vì 'user'
            'password' => 'required|min:6|max:32', // Sửa lỗi cú pháp
            'Repassword' => 'required|same:password',
        ]);

        // Kiểm tra xem có lỗi validation hay không
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Tạo người dùng mới
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Sửa lỗi về tên trường password
            'is_admin' => 0,
        ]);

        return redirect('/');
    }
}
