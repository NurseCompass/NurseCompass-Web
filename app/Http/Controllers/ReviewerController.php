<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reviewer;
use Illuminate\Support\Facades\Auth; // Added this to make Intelephense happy!

class ReviewerController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->role === 'faculty') {
            $myReviewers = Reviewer::where('user_id', $user->id)->latest()->get();
        } else {
            $studentSection = $user->section ?? 'None';

            $myReviewers = Reviewer::where('user_id', $user->id)
                ->orWhere(function ($query) use ($studentSection) {
                    $query->where('is_faculty_upload', true)
                          ->whereJsonContains('target_sections', $studentSection);
                })
                ->latest()
                ->get();
        }

        return view('reviewers.index', compact('myReviewers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,txt|max:10240',
            'target_sections' => 'nullable|array',
        ]);

        $filePath = $request->file('file')->store('reviewers', 'public');
        
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $isFaculty = $user->role === 'faculty';

        Reviewer::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'file_path' => $filePath,
            'category' => $request->category,
            'is_faculty_upload' => $isFaculty,
            'target_sections' => $isFaculty ? $request->target_sections : null,
        ]);

        return redirect()->back()->with('success', 'Study material uploaded successfully!');
    }

    public function edit(Reviewer $reviewer)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($reviewer->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('reviewers.edit', compact('reviewer'));
    }

    public function update(Request $request, Reviewer $reviewer)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($reviewer->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'target_sections' => 'nullable|array',
        ]);

        $reviewer->update([
            'title' => $request->title,
            'category' => $request->category,
            'target_sections' => $user->role === 'faculty' ? $request->target_sections : null,
        ]);

        return redirect()->route('reviewers.index')->with('success', 'Study material updated successfully!');
    }
}