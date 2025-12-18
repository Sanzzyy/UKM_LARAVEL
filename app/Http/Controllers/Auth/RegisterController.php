<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|min:3|unique:users,name',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:admin,kasir',
        ]);

        // 🔒 RULE BERDASARKAN ROLE
        if ($request->role === 'admin' && !str_contains(strtolower($request->name), 'admin')) {
            return back()->withErrors([
                'name' => 'Username admin HARUS mengandung kata "admin"'
            ])->withInput();
        }

        if ($request->role === 'kasir' && !str_contains(strtolower($request->name), 'karyawan')) {
            return back()->withErrors([
                'name' => 'Username kasir HARUS mengandung kata "karyawan"'
            ])->withInput();
        }

        // ✅ SIMPAN USER
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        // ✅ REDIRECT KE LOGIN + FEEDBACK
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
