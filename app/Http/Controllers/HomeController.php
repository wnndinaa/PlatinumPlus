<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User\User;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function welcome()
    {
        $currentUser = session('user');

        if (!$currentUser) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $users = [];

        if (strtolower($currentUser['role']) === 'staff') {
            $users = User::all(); // or filter as needed
        }

        return view('welcome', [
            'users' => $users
        ]);
    }

    public function exportUsers()
    {
        $users = User::all();

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
                fputcsv($file, [
                    $user->username,
                    $user->email,
                    $user->role,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


    public function deleteUser($username)
    {
        $currentUser = session('user');

        if (!$currentUser || strtolower($currentUser['role']) !== 'staff') {
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        if ($currentUser['username'] === $username) {
            return redirect()->back()->with('error', 'You cannot delete yourself.');
        }

        $user = \App\Models\User\User::where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }}
