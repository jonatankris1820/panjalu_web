<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }

        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $remember = $request->boolean('remember');

        /* Cek user aktif dulu sebelum attempt */
        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if ($user && ! $user->is_active) {
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'Akun Anda telah dinonaktifkan. Hubungi Super Admin.']);
        }

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return $this->redirectByRole(Auth::user());
        }

        return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    private function redirectByRole($user): \Illuminate\Http\RedirectResponse
    {
        return $user->isSuperAdmin()
            ? redirect()->route('admin.super.dashboard')
            : redirect()->route('admin.dashboard');
    }
}