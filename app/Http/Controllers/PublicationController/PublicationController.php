<?php

namespace App\Http\Controllers\PublicationController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\Platinum\Platinum;
use App\Models\Publication\Publication;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;



class PublicationController extends Controller
{

    // public function index(Request $request)
    // {
    //     // Retrieve Reg_ID from session
    //     $user = session('user');

    //     $username = $user->username;

    //     $keyword = $request->input('keyword');
    //     $line = 5;

    //     $query = Publication::where('username', $username);

    //     if (!empty($keyword)) {
    //         $query->where(function ($q) use ($keyword) {
    //             $q->where('publication_title', 'like', "%$keyword%")
    //                 ->orWhere('publication_type', 'like', "%$keyword%")
    //                 ->orWhere('publication_author', 'like', "%$keyword%");
    //         });
    //     }

    //     $publications = $query->orderBy('publication_id', 'desc')->paginate($line);

    //     return view('publication', compact('publications'));
    // }

    // Show List Of Uploaded Publications
    public function showMyPublication()
    {
        $user = session('user');

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $publications = Publication::where('username', $user->username)
            ->orderBy('publication_date', 'desc')
            ->paginate(7);

        return view('managePublication.platinumMyPublication', compact('publications'));
    }

    // Display publication Homepage
    public function showViewPublication()
    {
        $role = session('user.role') ?? 'Platinum';

        $publications = Publication::orderBy('publication_id', 'desc')->paginate(7);

        switch ($role) {
            case 'Platinum':
                return view('managePublication.platinumViewPublication', compact('publications'));
            case 'CRMP':
                return view('managePublication.CRMPViewPublication', compact('publications'));
            case 'Mentor':
                return view('managePublication.mentorViewPublication', compact('publications'));
            default:
                abort(403, 'Unauthorized action.');
        }
    }

    // Go to edit publication page
    public function editMyPublication($id)
    {
        $user = session('user');

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in.');
        }

        $publication = Publication::find($id);

        if (!$publication || $publication->username !== $user->username) {
            return redirect()->route('publication.my')->with('error', 'Unauthorized or not found.');
        }

        return view('managePublication.platinumEditPublication', compact('publication'));
    }

    // Store edited publication
    public function updateMyPublication(Request $request, $id)
    {
        $request->validate([
            'publication_title' => 'required|string',
            'publication_author' => 'required|string',
            'publication_date' => 'required|date',
            'publication_DOI' => 'required|string',
            'publication_type' => 'required|string',
            'publication_file' => 'nullable|file|mimes:pdf|max:20480',
        ]);

        $user = session('user');

        $publication = Publication::find($id);

        if (!$publication || $publication->username !== $user->username) {
            return redirect()->route('publication.my')->with('error', 'Unauthorized or not found.');
        }

        // Update file if uploaded
        // if ($request->hasFile('publication_file')) {
        //     \Storage::disk('public')->delete($publication->publication_file);
        //     $path = $request->file('publication_file')->store('publications', 'public');
        //     $publication->publication_file = $path;
        // }

        $publication->update([
            'publication_title' => $request->publication_title,
            'publication_author' => $request->publication_author,
            'publication_date' => $request->publication_date,
            'publication_DOI' => $request->publication_DOI,
            'publication_type' => $request->publication_type,
        ]);

        return redirect()->route('publication.MyPublication')->with('success', 'Publication updated successfully!');
    }


    // Go to Add New Publication Page
    public function addMyPublication()
    {
        return view('managePublication.platinumAddPublication');
    }

    // Store entered New Publication
    public function storeMyPublication(Request $request)
    {
        $request->validate([
            'publication_title' => 'required|string',
            'publication_author' => 'required|string',
            'publication_date' => 'required|date',
            'publication_DOI' => 'required|string',
            'publication_type' => 'required|string',
            'publication_file' => 'required|file|mimes:pdf|max:20480', // max 20MB
        ]);

        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in.');
        }

        $path = $request->file('publication_file')->store('publications', 'public');

        Publication::create([
            'publication_title' => $request->publication_title,
            'publication_author' => $request->publication_author,
            'publication_date' => $request->publication_date,
            'publication_DOI' => $request->publication_DOI,
            'publication_type' => $request->publication_type,
            'publication_file' => $path,
            'username' => $user->username,
        ]);

        return redirect()->route('publication.MyPublication')->with('success', 'Publication added successfully!');
    }

    // Delete an uploaded publication
    public function deletePublication($id)
    {
        $user = session('user');

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in.');
        }

        $publication = Publication::find($id);

        // Check if publication exists and belongs to logged-in user
        if (!$publication || $publication->username !== $user->username) {
            return redirect()->route('publication.MyPublication')->with('error', 'Unauthorized or not found.');
        }

        // Optionally delete the file from storage
        // if ($publication->publication_file) {
        //     \Storage::disk('public')->delete($publication->publication_file);
        // }

        $publication->delete();

        return redirect()->route('publication.MyPublication')->with('success', 'Publication deleted successfully.');
    }
}
