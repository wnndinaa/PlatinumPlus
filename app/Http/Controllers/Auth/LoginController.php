<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Profile\Profile;
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

        $user = Profile::where('username', $username)->first();

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
}
