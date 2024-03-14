<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    //
    function index()
    {
        $users=User::all();
        return view('admin.user.list',compact('users'));
    }
    function create()
    {
        return view('admin.user.create');
    }
public function store(Request $request)
{
     Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|unique:user|email',
        'pass' => 'required'|'min:6'|'max:32',
        'repass' => 'required|same:pass',
         'is_admin'=>'required',
    ]);
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->pass),
        'is_admin' => $request->is_admin,
    ]);

    return redirect()->route('admin.user.index');
}
    function edit($id)
    {
        $user=User::find($id);
        return view('admin.user.edit',compact('user'));
    }
    function update($id,Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'pass' => 'required'|'min:6'|'max:32',
            'repass' => 'required|same:pass',
            'is_admin'=>'required',
        ]);
        $user=User::find($id);
        $user->update([
           'name'=> $request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->pass),
            'is_admin'=>$request->is_admin,
        ]);
        return redirect()->route('admin.user.index');
    }
    function delete($id)
    {
        $user=User::find($id);
        $user->delete();
        return redirect()->route('admin.user.index');
    }
}
