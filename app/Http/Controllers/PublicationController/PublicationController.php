<?php

namespace App\Http\Controllers\PublicationController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\Platinum\Platinum;
use App\Models\Publication\Publication;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class PublicationController extends Controller
{
    // Show List Of Uploaded Publications
    public function showMyPublication(Request $request)
    {
        $user = session('user');

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $search = $request->input('search');

        $query = Publication::where('username', $user->username);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('publication_title', 'LIKE', '%' . $search . '%')
                    ->orWhere('publication_author', 'LIKE', '%' . $search . '%')
                    ->orWhere('publication_DOI', 'LIKE', '%' . $search . '%');
            });
        }

        $publications = $query->orderBy('publication_date', 'desc')->paginate(7);

        return view('managePublication.platinumMyPublication', compact('publications', 'search'));
    }

    // Display publication Homepage
    public function showViewPublication(Request $request)
    {
        $role = session('user.role') ?? 'Platinum';
        $search = $request->input('search');

        $query = Publication::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('publication_title', 'LIKE', '%' . $search . '%')
                    ->orWhere('publication_author', 'LIKE', '%' . $search . '%')
                    ->orWhere('publication_type', 'LIKE', '%' . $search . '%');
            });
        }


        $publications = $query->orderBy('publication_id', 'desc')->paginate(7);

        switch ($role) {
            case 'Platinum':
                return view('managePublication.platinumViewPublication', compact('publications', 'search'));
            case 'CRMP':
                return view('managePublication.CRMPViewPublication', compact('publications', 'search'));
            case 'Mentor':
                return view('managePublication.mentorViewPublication', compact('publications', 'search'));
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

    // Publication Report (Monthly & Yearly)
    public function showPublicationReport(Request $request)
    {
        $role = session('user.role') ?? 'Platinum';
        $user = session('user');

        $month = $request->input('month');
        $year = $request->input('year');

        $query = Publication::query();

        // Platinum users see only their own publications
        if ($role === 'Platinum' && $user) {
            $query->where('username', $user->username);
        }

        // Apply filters
        if ($month) {
            $query->whereMonth('publication_date', $month);
        }
        if ($year) {
            $query->whereYear('publication_date', $year);
        }

        // Paginated results
        $publications = $query->with('user')->orderBy('publication_date', 'desc')->paginate(5);

        // Stats
        $totalPublications = (clone $query)->count(); // still okay to clone here

        // Safe and fresh query for top contributor
        $topUser = Publication::query()
            ->when($month, fn($q) => $q->whereMonth('publication_date', $month))
            ->when($year, fn($q) => $q->whereYear('publication_date', $year))
            ->select('username', DB::raw('COUNT(*) as total'))
            ->groupBy('username')
            ->orderByDesc('total')
            ->first();


        $topContributorName = $topUser ? $topUser->username : 'N/A';

        $mostActiveMonth = null;
        if ($year) {
            $monthlyStats = Publication::selectRaw('MONTH(publication_date) as month, COUNT(*) as total')
                ->whereYear('publication_date', $year);

            if ($role === 'Platinum' && $user) {
                $monthlyStats->where('username', $user->username);
            }

            $most = $monthlyStats->groupBy('month')->orderByDesc('total')->first();
            $mostActiveMonth = $most ? Carbon::create()->month($most->month)->format('F') : null;
        }

        // Chart: Monthly trend
        $chartLabels = [];
        $chartData = [];

        if ($year) {
            $monthlyCounts = Publication::selectRaw('MONTH(publication_date) as month, COUNT(*) as count')
                ->whereYear('publication_date', $year);

            if ($role === 'Platinum' && $user) {
                $monthlyCounts->where('username', $user->username);
            }

            $monthlyCounts = $monthlyCounts->groupBy('month')->get();

            for ($m = 1; $m <= 12; $m++) {
                $chartLabels[] = Carbon::create()->month($m)->format('F');
                $count = $monthlyCounts->firstWhere('month', $m);
                $chartData[] = $count ? $count->count : 0;
            }
        }

        // Available years
        $yearQuery = Publication::selectRaw('YEAR(publication_date) as year')->distinct();
        if ($role === 'Platinum' && $user) {
            $yearQuery->where('username', $user->username);
        }
        $availableYears = $yearQuery->pluck('year')->sortDesc()->values();

        return view('managePublication.viewPublicationReport', compact(
            'publications',
            'totalPublications',
            'topContributorName',
            'mostActiveMonth',
            'chartLabels',
            'chartData',
            'availableYears'
        ));
    }
}
