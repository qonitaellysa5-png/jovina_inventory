<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /* ================= LANDING ================= */
    public function landing()
    {
        return view('auth.landing');
    }

    /* ================= LOGIN ================= */
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $admin = DB::table('admin')
            ->where('email', $request->email)
            ->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('admin_login', true);
            Session::put('admin', $admin);

            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    /* ================= REGISTER ================= */
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_admin' => 'required|string|max:100',
            'email'      => 'required|email|unique:admin,email',
            'password'   => 'required|min:6|confirmed'
        ]);

        // ====== AUTO GENERATE USERNAME ======

        $baseUsername = strtolower(strstr($request->email, '@', true) ?: 'user');
        $baseUsername = preg_replace('/[^a-z0-9_]/', '', $baseUsername); 
        if ($baseUsername === '') $baseUsername = 'user';


        $username = $baseUsername;
        $counter = 1;
        while (DB::table('admin')->where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        DB::table('admin')->insert([
            'nama_admin' => $request->nama_admin,
            'email'      => $request->email,
            'username'   => $username, 
            'password'   => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login');
    }

    /* ================= LUPA PASSWORD ================= */
    public function forgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        $admin = DB::table('admin')
            ->where('email', $request->email)
            ->first();

        if (!$admin) {
            Session::put('admin_login', true);
            Session::put('admin', $admin);

            return redirect()->route('dashboard');
        }
        return back()->with('error', 'Email atau password salah');

        DB::table('admin')
            ->where('email', $request->email)
            ->update([
                'password'   => Hash::make($request->password),
                'updated_at' => now()
            ]);

        return redirect()->route('login')
            ->with('success', 'Password berhasil diperbarui, silakan login');
    }

    /* ================= LOGOUT ================= */
    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}

