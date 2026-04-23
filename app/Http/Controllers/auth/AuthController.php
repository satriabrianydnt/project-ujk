<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
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

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            Alert::toast('Akun tidak ditemukan. Silakan cek kembali Email Anda.', 'error');
            return back()->onlyInput('email');
        }

        if (!Hash::check($request->password, $user->password)) {
            Alert::toast('Kata sandi yang Anda masukkan salah!', 'warning');
            return back()->onlyInput('email');
        }

        $remember = $request->has('remember-me');

        Auth::login($user, $remember);
        $request->session()->regenerate();

        Alert::toast('Berhasil masuk ke sistem!', 'success')->position('top-end');

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
