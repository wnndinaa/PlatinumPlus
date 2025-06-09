<?php

namespace App\Http\Controllers\ProfileController;

use App\Http\Controllers\Controller;
use App\Models\Profile\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Fetch the first profile (you can adjust this)
        $profile = Profile::first();

        return view('profile.profile', ['profile' => $profile]);
    }

    public function edit()
    {
        $profile = \App\Models\Profile\Profile::where('username', 'platinum123')->first();
        return view('profile.editprofile', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = \App\Models\Profile\Profile::where('username', 'platinum123')->first();

        $profile->update([
            'name' => $request->name,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'ic' => $request->ic,
            'role' => $request->role,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Your profile has been successfully edited.');
    }
}
