<?php

namespace App\Http\Controllers\ProfileController;

use App\Http\Controllers\Controller;
use App\Models\Profile\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Session::get('user');

        // Get own profile
        $profile = Profile::where('username', $user->username)->first();

        // Prepare query for search
        $query = Profile::query();

        // Role-based filtering
        switch ($user->role) {
            case 'Platinum':
                $query->where('role', 'Platinum')->where('id', '!=', $user->id);
                break;
            case 'CRMP':
                $query->whereIn('role', ['CRMP', 'Platinum']);
                break;
            case 'Mentor':
            case 'Staff':
                // No filtering, can search all
                break;
            default:
                abort(403, 'Unauthorized role.');
        }

        // Search by name or username
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            });
        }

        $results = $query->get();

        return view('profile.profile', [
            'profile' => $profile,
            'results' => $results
        ]);
    }

    public function edit()
    {
        $user = Session::get('user');
        $profile = Profile::where('username', $user->username)->first();

        return view('profile.editprofile', compact('profile'));
    }

    public function update(Request $request)
    {
        $user = Session::get('user');
        $profile = Profile::where('username', $user->username)->first();

        $profile->update([
            'name' => $request->name,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'ic' => $request->ic,
            'role' => $request->role,
        ]);

        Session::put('user', $profile);

        return redirect()->route('profile.edit')->with('success', 'Your profile has been successfully edited.');
    }
}
