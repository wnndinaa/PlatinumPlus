<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile\Profile;
use Illuminate\Support\Facades\Log;


class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function processRegister(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'username' => 'required|string|unique:profile,username',
            'password' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'ic' => 'required|string',
            'phonenumber' => 'required|string',
            'role' => 'required|in:Platinum,CRMP,Staff,Mentor',
        ]);

        Log::info('Validated data:', $validated);
        // Save to database
        $profile = new Profile();
        $profile->username = $validated['username'];
        $profile->password = $validated['password']; // optionally hash it
        $profile->name = $validated['name'];
        $profile->email = $validated['email'];
        $profile->ic = $validated['ic'];
        $profile->phonenumber = $validated['phonenumber'];
        $profile->role = $validated['role'];
        $profile->save();

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }
}
