<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reviewer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReviewerController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $facultySections = collect();

        if ($user->role === 'faculty') {
            $myReviewers = Reviewer::where('user_id', $user->id)->latest()->get();
            // Fetch sections assigned via the pivot table
            $facultySections = $user->handledSections;
        } else {
            // Student logic...
            $studentSectionNames = $user->enrolledSections->pluck('name')->toArray();

            $myReviewers = Reviewer::where('user_id', $user->id)
                ->orWhere(function ($query) use ($studentSectionNames) {
                    $query->where('is_faculty_upload', true)
                        ->where(function ($q) use ($studentSectionNames) {
                            foreach ($studentSectionNames as $sectionName) {
                                $q->orWhereJsonContains('target_sections', $sectionName);
                            }
                        });
                })
                ->latest()
                ->get();
        }

        return view('reviewers.index', compact('myReviewers', 'facultySections'));
    }

    public function store(Request $request)
    {
        // Added document_type validation
        $request->validate([
            'title' => 'required|string|max:255',
            'document_type' => 'required|string|in:PPT,Syllabus,Module,Reading Material',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,txt,zip|max:307200',
            'target_sections' => 'nullable|array',
        ]);

        $filePath = $request->file('file')->store('reviewers', 'public');

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $isFaculty = $user->role === 'faculty';

        // Added document_type to the creation array
        $reviewer = Reviewer::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'document_type' => $request->document_type,
            'file_path' => $filePath,
            'is_faculty_upload' => $isFaculty,
            'target_sections' => $isFaculty ? $request->target_sections : null,
        ]);

        try {
            $absolutePath = storage_path('app/public/' . $filePath);

            Http::timeout(300)->attach(
                'document',
                fopen($absolutePath, 'r'),
                $request->file('file')->getClientOriginalName()
            )->post('http://127.0.0.1:5001/api/train-chatbot', [
                'reviewer_id' => $reviewer->id,
                'title' => $reviewer->title,
            ]);
        } catch (\Exception $e) {
            Log::error('ML Server is offline or failed: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Study material uploaded successfully and sent to AI for training!');
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

        // Added document_type validation
        $request->validate([
            'title' => 'required|string|max:255',
            'document_type' => 'required|string|in:PPT,Syllabus,Module,Reading Material',
            'target_sections' => 'nullable|array',
        ]);

        // Added document_type to the update array
        $reviewer->update([
            'title' => $request->title,
            'document_type' => $request->document_type,
            'target_sections' => $user->role === 'faculty' ? $request->target_sections : null,
        ]);

        return redirect()->route('reviewers.index')->with('success', 'Study material updated successfully!');
    }
}
