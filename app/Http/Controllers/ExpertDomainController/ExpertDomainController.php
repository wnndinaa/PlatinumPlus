<?php

namespace App\Http\Controllers\ExpertDomainController;

use App\Http\Controllers\Controller;
use App\Models\ExpertDomain\ExpertDomain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ExpertDomainController extends Controller
{
    public function index(Request $request)
    {
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $username = Session::get('user')->username;
        $search = $request->input('search');

        $expertDomains = ExpertDomain::where('username', $username)
            ->when($search, function ($query, $search) {
                return $query->where(function ($subquery) use ($search) {
                    $subquery->where('expert_name', 'like', '%' . $search . '%')
                        ->orWhere('domain_expertise', 'like', '%' . $search . '%');
                });
            })
            ->get();


        return view('manageExpertDomain.index', compact('expertDomains', 'search'));
    }

    public function addExpert()
    {
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        return view('manageExpertDomain.addExpert');
    }
    public function editExpert($id)
    {
        $expert = ExpertDomain::findOrFail($id);
        return view('manageExpertDomain.editExpert', compact('expert'));
    }

    public function deleteExpert($id)
    {
        $expert = ExpertDomain::findOrFail($id);
        $expert->delete();
        return redirect()->route('manageExpertDomain.index')->with('success', 'Expert deleted successfully.');
    }


    //to store the added expert
    public function storeExpert(Request $request)
    {
        // Generate custom expert_id like expert1, expert2...
        $lastExpertId = DB::table('expert_domain')
            ->where('expert_id', 'like', 'expert%')
            ->orderByRaw("CAST(SUBSTRING(expert_id, 7) AS UNSIGNED) DESC")
            ->value('expert_id');

        if ($lastExpertId) {
            $num = (int) substr($lastExpertId, 6); // Remove 'expert' prefix
            $newExpertId = 'expert' . ($num + 1);
        } else {
            $newExpertId = 'expert1';
        }

        $request->validate([
            'expert_name' => 'required|string',
            'expert_university' => 'required|string',
            'expert_occupation' => 'required|string',
            'expert_phoneNum' => 'required|string',
            'expert_email' => 'required|email',
            'domain_expertise' => 'required|string',
        ]);

        $user = Session::get('user');

        ExpertDomain::create([
            'expert_id' => $newExpertId,
            'expert_name' => $request->expert_name,
            'expert_university' => $request->expert_university,
            'expert_occupation' => $request->expert_occupation,
            'expert_phoneNum' => $request->expert_phoneNum,
            'expert_email' => $request->expert_email,
            'domain_expertise' => $request->domain_expertise,
            'username' => $user->username,
        ]);

        return redirect()->route('manageExpertDomain.index')->with('success', 'Expert added successfully.');
    }

    //to store and update expert
    public function update(Request $request, $id)
    {
        $request->validate([
            'expert_name' => 'required|string',
            'expert_university' => 'required|string',
            'expert_occupation' => 'required|string',
            'expert_phoneNum' => 'required|string',
            'expert_email' => 'required|email',
            'domain_expertise' => 'required|string',
        ]);

        $expert = ExpertDomain::findOrFail($id);

        $expert->update([
            'expert_name' => $request->expert_name,
            'expert_university' => $request->expert_university,
            'expert_occupation' => $request->expert_occupation,
            'expert_phoneNum' => $request->expert_phoneNum,
            'expert_email' => $request->expert_email,
            'domain_expertise' => $request->domain_expertise,
        ]);

        return redirect()->route('manageExpertDomain.index')->with('success', 'Expert updated successfully.');
    }


    public function storePaper(Request $request, $expert_id)
    {
        $lastPaperId = DB::table('expert_paper')
            ->where('expertPaper_id', 'like', 'paper%')
            ->orderByRaw("CAST(SUBSTRING(expertPaper_id, 6) AS UNSIGNED) DESC")
            ->value('expertPaper_id');

        $newPaperId = $lastPaperId ? 'paper' . ((int) substr($lastPaperId, 5) + 1) : 'paper1';

        $request->validate([
            'paper_title' => 'required|string',
            'paper_DOI' => 'required|string',
            'paper_author' => 'required|string',
            'paper_date' => 'required|date',
        ]);

        $user = Session::get('user');

        DB::table('expert_paper')->insert([
            'expertPaper_id' => $newPaperId,
            'paper_title' => $request->paper_title,
            'paper_DOI' => $request->paper_DOI,
            'paper_author' => $request->paper_author,
            'paper_date' => $request->paper_date,
            'expert_id' => $expert_id,
            'username' => $user->username,
        ]);

        return redirect()->route('manageExpertDomain.paperList', $expert_id)->with('success', 'Paper added successfully.');
    }

    public function paperList($expert_id, Request $request)
    {
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $expert = ExpertDomain::findOrFail($expert_id);
        $search = $request->input('search');

        $papers = DB::table('expert_paper')
            ->select('expertPaper_id', 'paper_title', 'paper_date') // Explicitly include expertPaper_id
            ->where('expert_id', $expert_id)
            ->when($search, function ($query, $search) {
                return $query->where('paper_title', 'like', '%' . $search . '%');
            })
            ->get();


        return view('manageExpertDomain.paperList', compact('expert', 'papers', 'search'));
    }

    public function addPaper($expert_id)
    {
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $expert = ExpertDomain::findOrFail($expert_id);
        return view('manageExpertDomain.addPaper', compact('expert'));
    }
    public function editPaper($expertPaper_id)
    {
        $paper = DB::table('expert_paper')->where('expertPaper_id', $expertPaper_id)->first();
        $expert = ExpertDomain::findOrFail($paper->expert_id);

        return view('manageExpertDomain.editPaper', compact('paper', 'expert'));
    }

    public function updatePaper(Request $request, $expertPaper_id)
    {
        $request->validate([
            'paper_title' => 'required|string',
            'paper_DOI' => 'required|string',
            'paper_author' => 'required|string',
            'paper_date' => 'required|date',
        ]);

        $paper = DB::table('expert_paper')->where('expertPaper_id', $expertPaper_id)->first();

        DB::table('expert_paper')
            ->where('expertPaper_id', $expertPaper_id)
            ->update([
                'paper_title' => $request->paper_title,
                'paper_DOI' => $request->paper_DOI,
                'paper_author' => $request->paper_author,
                'paper_date' => $request->paper_date,
            ]);

        return redirect()->route('manageExpertDomain.paperList', $paper->expert_id)->with('success', 'Paper updated successfully.');
    }

    public function deletePaper($expertPaper_id)
    {
        DB::table('expert_paper')->where('expertPaper_id', $expertPaper_id)->delete();

        return redirect()->back()->with('success', 'Paper deleted successfully.');
    }

    //other platinum expert list
    public function platinumExpertList(Request $request)
    {
        $search = $request->input('search');

        $platinums = DB::table('platinum')
            ->join('user', 'platinum.username', '=', 'user.username')
            ->when($search, function ($query, $search) {
                return $query->where('expert_domain.domain_expertise', 'like', '%' . $search . '%');
            })

            ->join('expert_domain', 'platinum.username', '=', 'expert_domain.username')
            ->select('platinum.username', 'expert_domain.domain_expertise')
            ->get();

        return view('manageExpertDomain.platinumExpertList', compact('platinums', 'search'));
    }

    public function viewPlatinumExpert($username)
    {
        $platinum = DB::table('user')->where('username', $username)->first();

        if (!$platinum) {
            return redirect()->route('manageExpertDomain.platinumExpertList')->with('error', 'Platinum not found.');
        }

        // Get joined expert domain and papers
        $expertPapers = DB::table('expert_domain')
            ->join('expert_paper', 'expert_domain.expert_id', '=', 'expert_paper.expert_id')
            ->where('expert_domain.username', $username)
            ->select(
                'expert_domain.domain_expertise',
                'expert_paper.paper_title',
                'expert_paper.paper_date',
                'expert_paper.paper_DOI'
            )
            ->get();

        return view('manageExpertDomain.viewPlatinumExpert', compact('platinum', 'expertPapers'));
    }
    public function viewDomainExpertise($domain_expertise)
    {
        $currentUsername = Session::get('user')->username;

        $expertPapers = DB::table('expert_domain')
            ->join('expert_paper', 'expert_domain.expert_id', '=', 'expert_paper.expert_id')
            ->where('expert_domain.domain_expertise', $domain_expertise)
            ->where('expert_domain.username', '!=', $currentUsername) // 👈 exclude current user
            ->select(
                'expert_domain.domain_expertise',
                'expert_paper.paper_title',
                'expert_paper.paper_date',
                'expert_paper.paper_DOI',
                'expert_domain.expert_name',
                'expert_paper.expertPaper_id',
            )
            ->get();

        return view('manageExpertDomain.viewDomainExpertise', compact('domain_expertise', 'expertPapers'));
    }

    public function viewNotify($id)
    {
        $paper = DB::table('expert_paper')->where('expertPaper_id', $id)->first();

        if (!$paper) {
            return redirect()->back()->with('error', 'Paper not found.');
        }

        $notifications = DB::table('notification')
            ->where('expertPaper_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('manageExpertDomain.viewNotify', compact('paper', 'notifications'));
    }


    //for CRMP
    public function platinumList(Request $request)
    {
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $user = Session::get('user');

        // Ensure only CRMP can access
        if ($user->role !== 'CRMP') {
            return redirect()->route('expertDomain.redirect')->with('error', 'Unauthorized.');
        }

        $search = $request->input('search');

        $platinums = DB::table('platinum')
            ->join('user', 'platinum.username', '=', 'user.username')
            ->where('platinum.assignedCRMP', $user->username)
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('platinum.username', 'like', '%' . $search . '%')
                        ->orWhere('user.name', 'like', '%' . $search . '%');
                });
            })
            ->select('platinum.username', 'user.name')
            ->get();

        return view('manageExpertDomain.platinumList', compact('platinums', 'search'));
    }

    public function platinumReport()
    {
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $user = Session::get('user');

        if ($user->role !== 'CRMP') {
            return redirect()->route('expertDomain.redirect')->with('error', 'Unauthorized.');
        }

        // Get all Platinum users under this CRMP
        $platinums = DB::table('platinum')
            ->join('user', 'platinum.username', '=', 'user.username')
            ->where('platinum.assignedCRMP', $user->username)
            ->select('platinum.username', 'user.name')
            ->get();

        // For each platinum, get their domains and total papers
        foreach ($platinums as $platinum) {
            $expertDomains = DB::table('expert_domain')
                ->where('username', $platinum->username)
                ->get();

            $domainReports = [];

            $totalPaperCount = 0;

            foreach ($expertDomains as $domain) {
                $paperCount = DB::table('expert_paper')
                    ->where('expert_id', $domain->expert_id)
                    ->count();

                $domainReports[] = [
                    'domain' => $domain->domain_expertise,
                    'papers' => $paperCount
                ];

                $totalPaperCount += $paperCount;
            }

            $platinum->domains = $domainReports;
            $platinum->totalPapers = $totalPaperCount;
        }

        return view('manageExpertDomain.platinumReport', compact('platinums'));
    }

    public function viewAssignedPlatinumExpert($username)
    {
        $platinumUser = DB::table('user')->where('username', $username)->first();

        $expertDomains = DB::table('expert_domain')
            ->where('username', $username)
            ->get();

        foreach ($expertDomains as $domain) {
            $domain->papers = DB::table('expert_paper')
                ->where('expert_id', operator: $domain->expert_id)
                ->get();
        }

        return view('manageExpertDomain.viewAssignedPlatinumExpert', compact('platinumUser', 'expertDomains'));
    }

    public function notifyPlatinum($paper_id)
    {
        $paper = DB::table('expert_paper')->where('expertPaper_id', $paper_id)->first();
        $platinumUser = DB::table('user')->where('username', $paper->username)->first();

        return view('manageExpertDomain.notifyPlatinum', compact('paper', 'platinumUser'));
    }

    public function sendNotification(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'paper_id' => 'required|string',
            'message' => 'required|string',
        ]);

        $fromUser = Session::get('user')->username;
        $toUser = $request->username;

        //Generate custom notification_id (e.g., notif1, notif2...)
        $lastId = DB::table('notification')
            ->where('notification_id', 'like', 'notif%')
            ->orderByRaw("CAST(SUBSTRING(notification_id, 6) AS UNSIGNED) DESC")
            ->value('notification_id');

        $newId = $lastId ? 'notif' . ((int)substr($lastId, 5) + 1) : 'notif1';

        // Insert notification
        DB::table('notification')->insert([
            'notification_id' => $newId,
            'from_username' => $fromUser,
            'to_username' => $toUser,
            'expertPaper_id' => $request->paper_id,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('manageExpertDomain.platinumList')->with('success', 'Notification sent.');
    }
}
