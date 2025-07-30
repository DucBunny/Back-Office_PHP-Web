<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function postLogin(LoginRequest $request)
    {
        $info = $request->only('login_id', 'password');

        // Lấy user theo login_id
        $user = User::where('login_id', $info['login_id'])->first();
        $role = $user ? $user->role : null;

        // Chỉ cho phép role 1 (admin) và 2 (manager) đăng nhập
        if (in_array($role, [1, 2]) && Auth::attempt(array_merge($info, ['role' => $role]))) {
            return redirect()->route('home');
        }

        // Authentication failed, redirect back with error
        return redirect()->back()->withErrors([
            'login_id' => ' ',
            'password' => 'Login ID hoặc mật khẩu không đúng!'
        ])->withInput();
    }
}
