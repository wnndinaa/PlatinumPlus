<?php

namespace App\Http\Controllers\ProfileController;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\Platinum\Platinum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

        return redirect()->route('profile.edit')->with('success', 'Your profile has been successfully updated.');
    }

    public function requestDelete(Request $request)
    {
        $username = session('user.username');
        $user = User::where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if ($user->delete_requested) {
            return redirect()->back()->with('error', 'You have already requested account deletion.');
        }

        $user->delete_requested = true;

        if ($user->save()) {
            return redirect()->back()->with('success', 'Account deletion request submitted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to submit deletion request.');
        }
    }

    public function approveDelete($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if (!$user->delete_requested) {
            return redirect()->back()->with('error', 'No deletion request found for this user.');
        }

        $user->delete();
        return redirect()->back()->with('success', 'User "' . $username . '" has been deleted successfully.');
    }

    public function rejectDelete(Request $request, $username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if (!$user->delete_requested) {
            return redirect()->back()->with('error', 'No deletion request to reject.');
        }

        $user->delete_requested = false;
        $user->save();

        return redirect()->back()->with('success', 'Deletion request for "' . $username . '" has been rejected.');
    }
}
