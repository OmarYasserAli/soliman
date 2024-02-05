<?php
namespace App\Http\Controllers\Selling;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('admin.login', [
            'route' => 'seller.login'
        ]);
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
        if (Auth::guard('seller')->attempt(['email' => $request->email,'password' => $request->password,'active' => 1], $request->filled('remember'))) {
            return redirect()->intended('selling');
        }
        session()->flash('fails', 'These credentials do not match our records.');
        return back();
    }

    public function logout()
    {
        Auth::guard('seller')->logout();
        return redirect('selling');
    }
}
