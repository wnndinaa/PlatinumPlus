<?php

namespace App\Http\Controllers\ProfileController;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\Platinum\Platinum;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $currentUsername = session('user.username');
        $currentUser = User::where('username', $currentUsername)->first();

        if (!$currentUser) {
            return redirect()->route('login')->with('error', 'Please login to view your profile.');
        }

        $searchResults = collect();
        $hasSearched = false;

        if ($request->filled('searchText')) {
            $hasSearched = true;
            $searchText = $request->input('searchText');

            $searchResults = User::where('username', '!=', $currentUsername)
                ->where(function ($query) use ($searchText) {
                    $query->where('username', 'like', '%' . $searchText . '%')
                        ->orWhere('name', 'like', '%' . $searchText . '%');
                })
                ->get();
        }

        $platinum = Platinum::where('username', $currentUsername)->first();

        return view('manageProfile.profile', [
            'user' => $currentUser,
            'platinum' => $platinum,
            'searchResults' => $searchResults,
            'hasSearched' => $hasSearched
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

        return view('manageProfile.editprofile', compact('user', 'platinum'));
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

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'ic' => $request->ic,
            'role' => $request->role,
            'gender' => $request->gender,
            'citizenship' => $request->citizenship,
            'password' => $request->password ?? $user->password
        ]);

        if ($platinum) {
            $platinum->assignedCRMP = $request->assignedCRMP;
            $platinum->save();
        }

        // Make sure this route name exists in web.php or use direct path instead
        return redirect()->route('profile.edit')->with('success', 'Your profile has been successfully updated.');
    }
}
