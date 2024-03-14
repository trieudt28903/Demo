<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function login()
    {
        return view('admin.login.index');
    }
    public function checkLogin(Request $request)
    {

        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->route('admin.post.index');
        }
        return redirect()->route('admin.auth.login')->with('error','Đăng nhập thất bại');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.auth.login');
    }
    public function profile()
    {
        return view('admin.login.profile');
    }
    public function updateProfile(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',

            'pass' => 'required'|'min:6'|'max:32',
            'repass' => 'required|same:pass',

        ]);
        $user=Auth::user();
        $user->update([
            'name'=> $request->name,
            'password'=>bcrypt($request->pass),

        ]);
        return redirect()->route('admin.profile');
    }

}
