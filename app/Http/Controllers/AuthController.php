<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('user_id')) return redirect()->route('dashboard.index');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email atau kata sandi salah.')->withInput();
        }

        session(['user_id' => $user->id, 'user_name' => $user->name, 'user_role' => $user->role]);
        return redirect()->route('dashboard.index');
    }

    public function showRegister()
    {
        if (session('user_id')) return redirect()->route('dashboard.index');
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'phone'                 => 'nullable|string|max:20',
            'password'              => 'required|min:6|confirmed',
        ], [
            'name.required'         => 'Nama lengkap wajib diisi.',
            'email.required'        => 'Email wajib diisi.',
            'email.unique'          => 'Email sudah terdaftar.',
            'password.required'     => 'Kata sandi wajib diisi.',
            'password.min'          => 'Kata sandi minimal 6 karakter.',
            'password.confirmed'    => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = DB::transaction(function () use ($request) {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'password' => Hash::make($request->password),
                'role'     => 'umkm',
            ]);

            Store::create([
                'user_id'  => $user->id,
                'name'     => $user->name . ' Store',
                'category' => 'Kuliner',
            ]);

            return $user;
        });

        session(['user_id' => $user->id, 'user_name' => $user->name, 'user_role' => $user->role]);
        return redirect()->route('dashboard.index')->with('success', 'Akun berhasil dibuat!');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
