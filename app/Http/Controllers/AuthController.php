<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only('login_id', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }

        // Authentication failed, redirect back with error
        return redirect()->back()->withErrors(['login_id' => 'Invalid credentials'])->withInput();
    }
}
