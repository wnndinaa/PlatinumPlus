<?php

namespace App\Http\Controllers\ReportController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('draftThesis.index');
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
            'thesislink' => $request->input('thesislink'),
            'number' => (int) $request->input('number'),
            'startDate' => $request->input('startDate'),
            'enddate' => $request->input('enddate'),
            'totalpage' => (int) $request->input('totalpage'),
            'prepdays' => (int) $request->input('prepdays'),
            'feedback' => '', // default empty feedback
        ]);

        return redirect()->route('draftThesis.index')->with('success', 'Draft thesis submitted!');

    }

    public function show($id)
    {
        return view('draftThesis.show', ['id' => $id]);
    }
}
