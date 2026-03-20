<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController
{
    public function loginForm(): View
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        if ($user->role !== 'admin') {
            return back()->withErrors(['email' => 'Admin access only.']);
        }

        if (!$user->is_active) {
            return back()->withErrors(['email' => 'Your account is inactive.']);
        }

        auth()->login($user, $request->boolean('remember'));
        $user->update(['last_login_at' => now()]);

        return redirect()->route('admin.dashboard')->with('success', 'Welcome to Admin Dashboard');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
