<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Question;
use App\Models\Option;

class DeanAssessmentController extends Controller
{
    // 1. Show the Upload Form
    public function showUploadForm()
    {
        return view('department.upload-assessment');
    }

    // 2. Send PDF to Python AI and store results in Session
    public function parsePdf(Request $request)
    {
        $request->validate([
            'year_level' => 'required|string',
            'pdf_file' => 'required|mimes:pdf|max:10240',
        ]);

        $file = $request->file('pdf_file');

        try {
            $response = Http::timeout(120)
                ->attach('document', file_get_contents($file), $file->getClientOriginalName())
                ->post('http://127.0.0.1:5001/api/extract-questions', [
                    'year_level' => $request->year_level
                ]);

            if ($response->successful()) {
                $extractedData = $response->json();

                session(['pending_assessment' => $extractedData['questions']]);
                session(['pending_year_level' => $request->year_level]);

                return redirect()->route('department.assessment.review');
            }

            return back()->with('error', 'AI Extraction failed. Ensure your Python server is running.');
        } catch (\Exception $e) {
            return back()->with('error', 'Could not connect to AI server: ' . $e->getMessage());
        }
    }

    // 3. Show the Review Page
    public function showReviewPage()
    {
        $questions = session('pending_assessment');
        $yearLevel = session('pending_year_level');

        if (!$questions) {
            return redirect()->route('department.assessment.upload')->with('error', 'No pending questions to review.');
        }

        return view('department.review-assessment', compact('questions', 'yearLevel'));
    }

    // 4. Confirm and Save to Database
    public function confirmAssessment(Request $request)
    {
        $questions = session('pending_assessment');
        $yearLevel = session('pending_year_level');

        if (!$questions) {
            return redirect()->route('department.assessment.upload');
        }

        Question::where('year_level', $yearLevel)->update(['is_active' => false]);

        foreach ($questions as $q) {
            $newQuestion = Question::create([
                'year_level' => $yearLevel,
                'section' => $q['section'],
                'question_text' => $q['question_text'],
                'is_active' => true,
            ]);

            foreach ($q['options'] as $opt) {
                $newQuestion->options()->create([
                    'option_text' => $opt['option_text'],
                    'is_correct' => $opt['is_correct']
                ]);
            }
        }

        session()->forget(['pending_assessment', 'pending_year_level']);

        return redirect()->route('department.dashboard')->with('success', "New $yearLevel assessment successfully activated!");
    }

    // 5. Show History of Question Sets
    public function showHistory()
    {
        $history = Question::select('year_level', 'is_active', 'created_at')
            ->selectRaw('COUNT(*) as total_questions')
            ->groupBy('year_level', 'is_active', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('department.history', compact('history'));
    }

    // 6. Restore an Old Version
    public function restoreVersion(Request $request)
    {
        $request->validate([
            'year_level' => 'required|string',
            'created_at' => 'required|string',
        ]);

        Question::where('year_level', $request->year_level)->update(['is_active' => false]);

        Question::where('year_level', $request->year_level)
            ->where('created_at', $request->created_at)
            ->update(['is_active' => true]);

        return back()->with('success', "Assessment set from {$request->created_at} is now active for {$request->year_level}.");
    }
}
