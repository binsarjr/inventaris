<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            switch ($role) {
                case "admin":
                    return redirect('dashboard/admin');
                case "manajemen":
                    return redirect('dashboard/manajemen');
                case "anggota":
                    return redirect('dashboard/anggota');
                default:
                    return back()->with('error', 'Maaf, Role tidak valid!');
            }
        }
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            $role = Auth::user()->role;

            switch ($role) {
                case "admin":
                    return redirect('dashboard/admin');
                case "manajemen":
                    return redirect('dashboard/manajemen');
                case "anggota":
                    return redirect('dashboard/anggota');
                default:
                    return back()->with('error', 'Maaf, Role tidak valid!');
            }
        }

        return back()->with('error', 'Username atau Password Anda Salah!');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required|unique:user,username',
            'password' => 'required|min:8|confirmed',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        $user = new User;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->role = 'anggota';
        $user->remember_token = Str::random(10);
        $user->save();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
