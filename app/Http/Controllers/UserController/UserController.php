<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\User;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function userList()
    {
        $currentUser = session('user');

        if (!$currentUser) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        if (strtolower($currentUser['role']) !== 'staff') {
            return redirect()->route('welcome')->with('error', 'Unauthorized access.');
        }

        $users = User::all();
        return view('manageUser.userlist', compact('users')); // ✅ Corrected path
    }



    public function exportUsers(Request $request)
    {
        $format = $request->query('format', 'csv'); // default to CSV
        $users = User::all();

        if ($format === 'pdf') {
            // Export as PDF
            $pdf = Pdf::loadView('manageUser.userlist-pdf', ['users' => $users]);
            return $pdf->download('registered_users.pdf');
        } else {
            // Export as CSV
            $filename = "registered_users.csv";
            $headers = [
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$filename",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            ];

            $columns = ['Username', 'Email', 'Role'];

            $callback = function () use ($users, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
                foreach ($users as $user) {
                    fputcsv($file, [$user->username, $user->email, $user->role]);
                }
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
    }
}
