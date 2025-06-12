<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\Platinum\Platinum;
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
            'username' => 'required|string|unique:user,username',
            'password' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'ic' => 'required|string',
            'phonenumber' => 'required|string',
            'role' => 'required|in:Platinum,CRMP,Staff,Mentor',
            'gender' => 'required|in:Male,Female',
            'citizenship' => 'required|string',
        ]);

        Log::info('Validated data:', $validated);
        // Save to database
        $user = new User();
        $user->username = $validated['username'];
        $user->password = $validated['password']; // optionally hash it
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->ic = $validated['ic'];
        $user->phonenumber = $validated['phonenumber'];
        $user->role = $validated['role'];
        $user->gender = $validated['gender'];
        $user->citizenship = $validated['citizenship'];
        $user->save();

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }
}
