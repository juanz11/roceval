<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'Usuario o contraseña incorrectos.',
            ])->onlyInput('email');
        }

        if (($user->role ?? 'visitor') !== 'admin') {
            return back()->withErrors([
                'email' => 'No tienes permisos para acceder al panel.',
            ])->onlyInput('email');
        }

        $request->session()->put('is_admin', true);
        $request->session()->put('admin_user_id', $user->id);

        return redirect()->route('admin.solicitudes.index');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');
        $request->session()->forget('admin_user_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login.show');
    }
}
