<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admins.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate( $request,
            [
            'email' => 'required',
            // 'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('index.dashboard');
        }else{
            return redirect()->back()->with('fail', 'Login ou mot de passe incorrect');
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('Admin.showLoginForm')->with('success', 'Vous êtes déconnecté');
    }
}
