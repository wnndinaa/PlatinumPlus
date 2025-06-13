<?php

namespace App\Http\Controllers;

use App\Models\ExpertDomain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpertDomainController extends Controller
{
    public function index()
    {
        $experts = ExpertDomain::where('user_id', Auth::id())->get();
        return view('experts.index', compact('experts'));
    }

    public function create()
    {
        return view('experts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'expert_name' => 'required|string|max:255',
            'expert_university' => 'required|string|max:150',
            'expert_occupation' => 'required|string|max:100',
            'expert_phoneNum' => 'required|string|max:20',
            'expert_email' => 'required|email|max:255',
            'domain_expertise' => 'required|string|max:255',
        ]);

        ExpertDomain::create([
            'expert_name' => $request->expert_name,
            'expert_university' => $request->expert_university,
            'expert_occupation' => $request->expert_occupation,
            'expert_phoneNum' => $request->expert_phoneNum,
            'expert_email' => $request->expert_email,
            'domain_expertise' => $request->domain_expertise,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('experts.index')->with('success', 'New expert added successfully.');
    }

    public function edit($id)
    {
        $expert = ExpertDomain::where('expert_id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        return view('experts.edit', compact('expert'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'expert_name' => 'required|string|max:255',
            'expert_university' => 'required|string|max:150',
            'expert_occupation' => 'required|string|max:100',
            'expert_phoneNum' => 'required|string|max:20',
            'expert_email' => 'required|email|max:255',
            'domain_expertise' => 'required|string|max:255',
        ]);

        $expert = ExpertDomain::where('expert_id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $expert->update($request->only([
            'expert_name',
            'expert_university',
            'expert_occupation',
            'expert_phoneNum',
            'expert_email',
            'domain_expertise',
        ]));

        return redirect()->route('experts.index')->with('success', 'Expert information updated successfully.');
    }
}
