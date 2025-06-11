<?php

namespace App\Http\Controllers\ProfileController;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\Platinum\Platinum;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $username = session('user.username');

        if (!$username) {
            return redirect()->route('login')->with('error', 'Please login to view your profile.');
        }

        $user = User::where('username', $username)->first();
        $platinum = Platinum::where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User profile not found.');
        }

        return view('profile.profile', [
            'user' => $user,
            'platinum' => $platinum
        ]);
    }

    public function edit()
    {
        $username = session('user.username');

        if (!$username) {
            return redirect()->route('login')->with('error', 'Please login to edit your profile.');
        }

        $user = User::where('username', $username)->first();
        $platinum = Platinum::where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User profile not found.');
        }

        return view('profile.editprofile', compact('user', 'platinum'));
    }

    public function update(Request $request)
    {
        $username = session('user.username');

        if (!$username) {
            return redirect()->route('login')->with('error', 'Please login to update your profile.');
        }

        $user = User::where('username', $username)->first();
        $platinum = Platinum::where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User profile not found.');
        }

        // Update user fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phonenumber = $request->phonenumber;
        $user->ic = $request->ic;
        $user->role = $request->role;
        $user->gender = $request->gender;
        $user->citizenship = $request->citizenship;

        // Only update password if filled
        if (!empty($request->password)) {
            $user->password = $request->password; // Or Hash::make($request->password) if you're using hashing
        }

        $user->save();

        // If user is platinum, update additional fields
        if ($platinum) {
            $platinum->assignedCRMP = $request->assignedCRMP;
            $platinum->save();
        }

        return redirect()->route('profile.edit')->with('success', 'Your profile has been successfully updated.');
    }
}
