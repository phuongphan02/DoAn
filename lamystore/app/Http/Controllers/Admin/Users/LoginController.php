<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
  public function logout()
  {
    return redirect()->route('admin.login')->with(Auth::logout());
  }
  public function index()
  {
    return view('admin.login', [
      'title' => 'Đăng nhập hệ thống'
    ]);
  }
  public function store(Request $request)
  {
    $this->validate($request, [
      'email' => 'required|email:filter',
      'password' => 'required'
    ]);

    if (Auth::attempt([
      'email' => $request->input('email'),
      'password' => $request->input('password'),
    ], $request->has('remember_token'))) {
      {
        return redirect()->route('admin');
      }
    }

    Session::flash('error', 'Email hoặc Mật khẩu không đúng');
    return redirect()->back();
  }

  public function messages()
  {
    return [
      'email.required' => 'Vui lòng nhập email',
      'password.required' => 'Vui lòng mật khẩu',
    ];
  }
}