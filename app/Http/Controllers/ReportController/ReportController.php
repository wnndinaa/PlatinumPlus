<?php

namespace App\Http\Controllers\ReportController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\draftThesis\draftThesis;
use Illuminate\Support\Facades\Session;


class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Get session user
        $user = session('user'); // expecting an object like (username, role)

        // Redirect unauthorized users
        if (!$user || $user->role !== 'Platinum') {
            return redirect()->route('welcome')->with('error', 'Unauthorized access.');
        }

        // Get search input
        $search = $request->input('search');

        // Build the query
        $query = DraftThesis::where('username', $user->username);

        // If there's a search term, filter by ID
        if ($search) {
            $query->where('id', 'like', '%' . $search . '%');
        }

        // Get the results
        $drafts = $query->latest()->get();

        // Pass both drafts and search value to the view
        return view('draftThesis.index', [
            'draftthesis' => $drafts,
            'search' => $search,
        ]);
    }

    public function create()
    {

        $user = session('user');

        if (!$user || $user->role !== 'Platinum') {
            return redirect()->route('welcome')->with('error', 'Unauthorized access.');
        }

        return view('draftThesis.create');
    }

    public function store(Request $request)
    {
        $user = session('user');

        if (!$user || $user->role !== 'Platinum') {
            return redirect()->route('welcome')->with('error', 'Unauthorized access.');
        }

        // Generate custom ID like DT001, DT002...
        $lastId = DB::table('draftthesis')->orderBy('id', 'desc')->value('id');

        if ($lastId) {
            $num = (int) substr($lastId, 2); // Remove 'DT' prefix and convert to int
            $newId = 'DT' . str_pad($num + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newId = 'DT001';
        }

        // Get the logged in username from session
        $user = session('user'); // from your custom login system
        $username = $user->username ?? 'guest'; // fallback if not found

        // Save the data
        DB::table('draftthesis')->insert([
            'id' => $newId,
            'username' => $username,
            'title' => $request->title,
            'thesislink' => $request->input('thesislink'),
            'description' => $request->description,
            'number' => (int) $request->input('number'),
            'startDate' => $request->input('startDate'),
            'enddate' => $request->input('enddate'),
            'totalpage' => (int) $request->input('totalpage'),
            'prepdays' => (int) $request->input('prepdays'),
            'feedback' => '', // default empty feedback
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        return redirect()->route('draftThesis.index')->with('success', 'Draft thesis submitted!');
    }
    public function viewFeedback($id)
    {
        $user = session('user');

        // Ensure it's a Platinum user
        if (!$user || $user->role !== 'Platinum') {
            return redirect()->route('welcome')->with('error', 'Unauthorized access.');
        }

        // Find the draft and ensure it belongs to the logged-in user
        $draft = draftThesis::where('id', $id)
            ->where('username', $user->username)
            ->firstOrFail();

        return view('draftThesis.viewFeedback', compact('draft'));
    }

    public function show($id)
    {
        $draft = draftThesis::findOrFail($id);
        return view('draftThesis.show', compact('draft'));
    }
    public function edit($id)
    {
        $user = session('user');
        $draft = draftThesis::where('id', $id)->where('username', $user->username)->firstOrFail();
        return view('draftThesis.edit', compact('draft'));
    }

    public function update(Request $request, $id)
    {
        $user = session('user');

        // Ensure the correct user's data is updated
        $draft = draftThesis::where('id', $id)
            ->where('username', $user->username)
            ->firstOrFail();

        $draft->update([
            'title' => $request->title,
            'thesislink' => $request->input('thesislink'),
            'description' => $request->description,
            'number' => $request->input('number'),
            'startDate' => $request->input('startDate'),
            'enddate' => $request->input('enddate'),
            'totalpage' => $request->input('totalpage'),
            'prepdays' => $request->input('prepdays'),
        ]);

        return redirect()->route('draftThesis.index')->with('success', 'Draft thesis updated successfully!');
    }
    public function destroy($id)
    {
        $report = DraftThesis::findOrFail($id); // or Report::findOrFail($id) if your model is named Report
        $report->delete();

        return redirect()->route('draftThesis.index')->with('success', 'Draft thesis deleted successfully.');
    }
    public function crmpPlatinumList(Request $request)
    {
        $crmpUsername = session('user')->username;
        $search = $request->input('search');

        $query = DB::table('platinum')
            ->join('user', 'platinum.username', '=', 'user.username')
            ->where('platinum.assignedCRMP', $crmpUsername);

        if ($search) {
            $query->where('user.name', 'like', '%' . $search . '%');
        }

        $platinums = $query->select('platinum.*', 'user.email', 'user.phonenumber', 'user.name')->get();

        return view('draftThesis.platinumList', compact('platinums', 'search'));
    }


    public function viewPlatinumDrafts($username)
    {
        $user = DB::table('user')->where('username', $username)->first(); // Get full user info

        $drafts = draftThesis::where('username', $username)->get();

        return view('draftThesis.platinumDrafts', [
            'drafts' => $drafts,
            'name' => $user->name,
        ]);
    }

    // Show form to add feedback
    public function addFeedback($id)
    {
        $draft = draftThesis::findOrFail($id);
        return view('draftThesis.addfeedback', compact('draft'));
    }

    public function storeFeedback(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required|string|max:1000',
        ]);

        $draft = draftThesis::findOrFail($id);
        $draft->feedback = $request->input('feedback');
        $draft->save();

        return redirect()->route('draftThesis.platinumDrafts', $draft->username)
            ->with('success', 'Feedback added successfully.');
    }


    // Show form to edit feedback
    public function editFeedback($id)
    {
        $draft = draftThesis::findOrFail($id);
        return view('draftThesis.editfeedback', compact('draft'));
    }
    public function updateFeedback(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required|string|max:1000',
        ]);

        $draft = draftThesis::findOrFail($id);
        $draft->feedback = $request->input('feedback');
        $draft->save();

        return redirect()->route('draftThesis.platinumDrafts', $draft->username)
            ->with('success', 'Feedback updated successfully.');
    }


    // Handle delete feedback
    public function deleteFeedback($id)
    {
        $draft = draftThesis::findOrFail($id);
        $draft->feedback = '';
        $draft->save();

        return redirect()->back()->with('success', 'Feedback deleted successfully.');
    }
}
