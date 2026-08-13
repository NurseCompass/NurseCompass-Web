<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reviewer;
use Illuminate\Support\Facades\Auth; // Added this to make Intelephense happy!
use Illuminate\Support\Facades\Http; // <-- Added for the ML Bridge
use Illuminate\Support\Facades\Log;  // <-- Added to log ML errors safely

class ReviewerController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->role === 'faculty') {
            // Faculty see all the materials they uploaded
            $myReviewers = Reviewer::where('user_id', $user->id)->latest()->get();
        } else {
            // STUDENTS: Get ALL the names of the sections this student is enrolled in
            $studentSectionNames = $user->enrolledSections->pluck('name')->toArray();

            $myReviewers = Reviewer::where('user_id', $user->id)
                ->orWhere(function ($query) use ($studentSectionNames) {
                    $query->where('is_faculty_upload', true)
                        ->where(function ($q) use ($studentSectionNames) {
                            // Check if the uploaded material's target_sections matches ANY of the student's sections
                            foreach ($studentSectionNames as $sectionName) {
                                $q->orWhereJsonContains('target_sections', $sectionName);
                            }
                        });
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

        // 1. Save the file to Laravel's storage
        $filePath = $request->file('file')->store('reviewers', 'public');

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $isFaculty = $user->role === 'faculty';

        // 2. Save the details to the MySQL Database
        $reviewer = Reviewer::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'file_path' => $filePath,
            'category' => $request->category,
            'is_faculty_upload' => $isFaculty,
            'target_sections' => $isFaculty ? $request->target_sections : null,
        ]);

        // 3. --- NEW: MACHINE LEARNING TRIGGER ---
        // Only send it to the AI if it's a Faculty upload (official study materials)
        if ($isFaculty) {
            try {
                // Get the actual physical path of the file on your computer
                $absolutePath = storage_path('app/public/' . $filePath);

                // Send a POST request with the file attached to your Python server 
                // (Assuming Python will run locally on port 5000)
                Http::timeout(10)->attach(
                    'document',
                    file_get_contents($absolutePath),
                    $request->file('file')->getClientOriginalName()
                )->post('http://127.0.0.1:5000/api/train-chatbot', [
                    'reviewer_id' => $reviewer->id,
                    'title' => $reviewer->title,
                    'category' => $reviewer->category,
                ]);
            } catch (\Exception $e) {
                // If Python is offline, don't crash Laravel! Just log it.
                Log::error('ML Server is offline or failed: ' . $e->getMessage());
            }
        }
        // -----------------------------------------

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
