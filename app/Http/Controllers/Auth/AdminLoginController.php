<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $request->email)->first();
        // dd($user);

        if ($user && $user->role == 'customer') {
            return back()->withErrors(['error' => 'You are not allowed to login from here']);
        }

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['error' => 'Invalid credentials']);
    }
}

