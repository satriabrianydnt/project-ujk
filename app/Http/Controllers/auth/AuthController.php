<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            Alert::toast('Akun tidak ditemukan.', 'error');
            return back()->onlyInput('email');
        }

        if (!Hash::check($request->password, $user->password)) {
            Alert::toast('Kata sandi yang Anda masukkan salah!', 'warning');
            return back()->onlyInput('email');
        }

        $remember = $request->has('remember-me');

        Auth::login($user, $remember);
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
