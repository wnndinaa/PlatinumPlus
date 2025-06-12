<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Profile\Profile;
use App\Models\User\User;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $role = $request->input('role');

        $user = User::where('username', $username)->where('role', $role)->first();

        if ($user) {
            if ($user->password === $password) {

                Session::put('user', $user);

                return redirect()->route('welcome')->with('success', 'You have been successfully logged in!');
            }
        }
        return back()->with('error', 'Invalid credentials')->withInput();
    }

    public function username()
    {
        return 'username';
    }


    public function logout(Request $request)
    {
        // Remove session manually
        $request->session()->forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have successfully logged out.');
    }
}
