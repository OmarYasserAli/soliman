<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
            //'g-recaptcha-response' => 'required|captcha'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if (Auth::attempt(['email' => $request->email,'password' => $request->password,'active' => 1], $request->filled('remember'))) {
            return redirect()->intended('admin');
        }
        session()->flash('fails', 'These credentials do not match our records.');
        return back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
