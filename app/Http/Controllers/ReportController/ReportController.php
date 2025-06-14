<?php

namespace App\Http\Controllers\ReportController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\draftThesis\draftThesis;
use App\Models\weeklyprogress\WeeklyProgress;
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

        // Count total submitted
        $totalDrafts = DraftThesis::where('username', $user->username)->count();

        // Pass everything to the view
        return view('draftThesis.index', [
            'draftthesis' => $drafts,
            'search' => $search,
            'totalDrafts' => $totalDrafts,
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
    public function draftThesisReport()
    {
        $crmpUsername = session('user')->username;

        // Join platinum with user (to get name/email), and join with draftthesis (optional)
        $reportData = DB::table('platinum')
            ->join('user', 'platinum.username', '=', 'user.username')
            ->leftJoin('draftthesis', 'platinum.username', '=', 'draftthesis.username')
            ->where('platinum.assignedCRMP', $crmpUsername)
            ->select(
                'platinum.username',
                'user.name',
                'user.email',
                DB::raw('COUNT(draftthesis.id) as total_drafts'),
                DB::raw('SUM(CASE WHEN draftthesis.feedback IS NOT NULL AND draftthesis.feedback != "" THEN 1 ELSE 0 END) as total_feedback')
            )
            ->groupBy('platinum.username', 'user.name', 'user.email')
            ->get();

        return view('draftThesis.crmpReport', compact('reportData'));
    }
    public function viewAllPlatinumReport(Request $request)
    {
        $crmpUsername = session('user')->username;

        $minTotalDrafts = $request->input('min_total_drafts');
        $latestUpdated = $request->input('latest_updated');

        $query = DB::table('platinum')
            ->join('user', 'platinum.username', '=', 'user.username')
            ->leftJoin('draftthesis', 'platinum.username', '=', 'draftthesis.username')
            ->where('platinum.assignedCRMP', $crmpUsername)
            ->select(
                'user.name',
                'user.email',
                'platinum.username',
                DB::raw('COUNT(draftthesis.id) as total_drafts'),
                DB::raw('MAX(draftthesis.updated_at) as latest_updated')
            )
            ->groupBy('platinum.username', 'user.name', 'user.email');

        // ✅ Make sure it's not null AND is numeric
        if (!is_null($minTotalDrafts) && is_numeric($minTotalDrafts)) {
            $query->having('total_drafts', '>=', (int)$minTotalDrafts);
        }

        if (!empty($latestUpdated)) {
            $query->havingRaw('DATE(MAX(draftthesis.updated_at)) = ?', [$latestUpdated]);
        }

        $reportData = $query->get();

        return view('draftThesis.allPlatinumReport', compact('reportData', 'minTotalDrafts', 'latestUpdated'));
    }



    //Weekly Progress module
    public function weeklyProgressIndex(Request $request)
    {
        $user = session('user');

        if (!$user || $user->role !== 'Platinum') {
            return redirect()->route('welcome')->with('error', 'Unauthorized access.');
        }

        $search = $request->input('search');

        $query = WeeklyProgress::where('username', $user->username);

        if ($search) {
            $query->where('id', 'like', '%' . $search . '%');
        }

        $progressReports = $query->latest()->get();

        // Count total progress
        $totalProgress = WeeklyProgress::where('username', $user->username)->count();

        return view('weeklyprogress.index', [
            'weeklyprogress' => $progressReports,
            'search' => $search,
            'totalProgress' => $totalProgress,
        ]);
    }

    // Show Create Form
    public function weeklyProgressCreate()
    {
        $user = session('user');

        if (!$user || $user->role !== 'Platinum') {
            return redirect()->route('welcome')->with('error', 'Unauthorized access.');
        }

        return view('weeklyprogress.create');
    }

    // Store Progress
    public function weeklyProgressStore(Request $request)
    {
        $user = session('user');

        if (!$user || $user->role !== 'Platinum') {
            return redirect()->route('welcome')->with('error', 'Unauthorized access.');
        }

        // Validate input
        $validated = $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'progressinfo' => 'required|string',
        ]);

        // Generate custom ID like WP001, WP002
        $lastId = DB::table('weeklyprogress')->orderBy('id', 'desc')->value('id');

        if ($lastId) {
            $num = (int) substr($lastId, 2); // remove WP
            $newId = 'WP' . str_pad($num + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newId = 'WP001';
        }

        // Create entry
        WeeklyProgress::create([
            'id' => $newId,
            'username' => $user->username,
            'startDate' => $validated['startDate'],
            'endDate' => $validated['endDate'],
            'progressinfo' => $validated['progressinfo'],
            'feedback' => null, // initially blank
        ]);

        return redirect()->route('weeklyprogress.index')->with('success', 'Weekly progress submitted successfully.');
    }
    public function weeklyProgressEdit($id)
    {
        $user = session('user');
        $progress = WeeklyProgress::where('id', $id)->where('username', $user->username)->firstOrFail();
        return view('weeklyprogress.edit', compact('progress'));
    }

    public function weeklyProgressUpdate(Request $request, $id)
    {
        $user = session('user');

        $progress = WeeklyProgress::where('id', $id)
            ->where('username', $user->username)
            ->firstOrFail();

        $progress->update([
            'startDate' => $request->input('startDate'),
            'endDate' => $request->input('endDate'),
            'progressinfo' => $request->input('progressinfo'),
        ]);

        return redirect()->route('weeklyprogress.index')->with('success', 'Weekly progress updated successfully!');
    }
    public function weeklyProgressDestroy($id)
    {
        $user = session('user');

        $progress = WeeklyProgress::where('id', $id)
            ->where('username', $user->username)
            ->firstOrFail();

        $progress->delete();

        return redirect()->route('weeklyprogress.index')->with('success', 'Weekly progress deleted successfully!');
    }
    public function showWeeklyProgressFeedback($id)
    {
        $user = session('user');

        $progress = WeeklyProgress::where('id', $id)
            ->where('username', $user->username)
            ->firstOrFail();

        return view('weeklyprogress.viewFeedback', compact('progress'));
    }

    //CRMP progress list feedback
    public function crmpWeeklyProgressList(Request $request) //show platinum weekly progress list
    {
        //dd('Entered CRMP Weekly Progress List'); // temporary for debugging
        $crmpUsername = session('user')->username;
        $search = $request->input('search');

        // Get Platinums assigned to this CRMP
        $query = DB::table('platinum')
            ->join('user', 'platinum.username', '=', 'user.username')
            ->where('platinum.assignedCRMP', $crmpUsername);

        if ($search) {
            $query->where('user.name', 'like', '%' . $search . '%');
        }

        $platinums = $query->select('platinum.*', 'user.email', 'user.phonenumber', 'user.name')->get();

        return view('weeklyprogress.WPplatinumList', compact('platinums', 'search'));
    }
    public function showPlatinumWeeklyList($username) //platinum List
    {
        $user = session('user');

        // Ensure CRMP is only viewing their own assigned Platinum
        $isAssigned = DB::table('platinum')
            ->where('username', $username)
            ->where('assignedCRMP', $user->username)
            ->exists();

        if (!$isAssigned) {
            return redirect()->back()->with('error', 'You are not assigned to this Platinum.');
        }

        // Get full name
        $platinum = DB::table('user')->where('username', $username)->first();
        $name = $platinum->name ?? $username;

        $weeklyProgress = DB::table('weeklyprogress')
            ->where('username', $username)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('weeklyprogress.WPviewPlatinumProgress', compact('weeklyProgress', 'name', 'username'));
    }
    // Show form to add feedback
    public function WPaddFeedback($id)
    {
        $progress = WeeklyProgress::findOrFail($id);
        return view('weeklyprogress.addfeedback', compact('progress'));
    }

    public function WPstoreFeedback(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required|string|max:1000',
        ]);

        $progress = WeeklyProgress::findOrFail($id);
        $progress->feedback = $request->input('feedback');
        $progress->save();

        return redirect()->route('weeklyprogress.WPviewPlatinumProgress', $progress->username)
            ->with('success', 'Feedback added successfully.');
    }

    // Show form to edit feedback
    public function WPeditFeedback($id)
    {
        $progress = WeeklyProgress::findOrFail($id);
        return view('weeklyprogress.editfeedback', compact('progress'));
    }

    public function WPupdateFeedback(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required|string|max:1000',
        ]);

        $progress = WeeklyProgress::findOrFail($id);
        $progress->feedback = $request->input('feedback');
        $progress->save();

        return redirect()->route('weeklyprogress.WPviewPlatinumProgress', $progress->username)
            ->with('success', 'Feedback updated successfully.');
    }

    // Handle delete feedback
    public function WPdeleteFeedback($id)
    {
        $progress = WeeklyProgress::findOrFail($id);
        $progress->feedback = ''; // clears the feedback column
        $progress->save();

        return redirect()->back()->with('success', 'Feedback deleted successfully.');
    }
    public function weeklyProgressReport(Request $request)
    {
        $crmpUsername = session('user')->username;
        $totalFilter = $request->input('total_progress'); // Number filter
        $dateFilter = $request->input('last_updated');   // Date filter

        $query = DB::table('platinum')
            ->join('user', 'platinum.username', '=', 'user.username')
            ->leftJoin('weeklyprogress', 'platinum.username', '=', 'weeklyprogress.username')
            ->select('platinum.username', 'user.name', DB::raw('MAX(weeklyprogress.updated_at) as last_updated'), DB::raw('COUNT(weeklyprogress.id) as total_progress'))
            ->where('platinum.assignedCRMP', $crmpUsername)
            ->groupBy('platinum.username', 'user.name');

        if ($totalFilter !== null) {
            $query->having('total_progress', '>=', $totalFilter);
        }

        if ($dateFilter) {
            $query->havingRaw('DATE(MAX(weeklyprogress.updated_at)) = ?', [$dateFilter]);
        }

        $data = $query->get();

        return view('weeklyprogress.report', compact('data', 'totalFilter', 'dateFilter'));
    }
}
