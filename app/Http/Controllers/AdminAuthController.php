<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $envUser = env('ADMIN_USER', 'admin');
        $envPass = env('ADMIN_PASSWORD', 'admin123');

        if ($credentials['username'] === $envUser && $credentials['password'] === $envPass) {
            $request->session()->put('is_admin', true);

            return redirect()->route('admin.solicitudes.index');
        }

        return back()->withErrors([
            'username' => 'Usuario o contraseña incorrectos.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login.show');
    }
}
