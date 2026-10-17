<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Option;
use App\Models\QuizResult; // Add this
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this
use Illuminate\Support\Facades\Http; // Add this with your other uses

class QuizController extends Controller
{
    public function takeQuiz()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // If the logged-in user is a faculty member, block them from taking quizzes
        if ($user->role === 'faculty') {
            return redirect()->route('dashboard')->with('error', 'Faculty members cannot take student assessments.');
        }

        // 1. Check if they already took the assessment
        $alreadyFinished = QuizResult::where('user_id', $user->id)
            ->where('year_level', $user->year_level)
            ->exists();

        if ($alreadyFinished) {
            return redirect('/dashboard')->with('error', 'You have already completed your assessment for this year.');
        }

        // 2. Fetch ALL active questions for their year level
        $questions = Question::where('year_level', $user->year_level)
            ->where('is_active', true) // <--- ADD THIS LINE
            ->with('options')
            ->get();

        // 3. Group the questions by section so the Blade file can organize them
        $groupedQuestions = $questions->groupBy('section');

        // 4. Send them to the single-page form
        return view('quiz.show', compact('groupedQuestions'));
    }

    public function showQuiz(string $slug)
    {
        $sections = [
            'academic-performance' => 'Academic Performance',
            'self-efficacy'        => 'Self-Efficacy',
            'initiative'           => 'Initiative',
            'motivation'           => 'Motivation',
        ];

        if (!array_key_exists($slug, $sections)) {
            abort(404);
        }

        $dbSection = $sections[$slug];
        $user = request()->user();

        // THE NEW BLOCKADE: Check if they already took this exact section
        $alreadyFinished = QuizResult::where('user_id', $user->id)
            ->where('section', $dbSection)
            ->exists();

        if ($alreadyFinished) {
            // Kick them back to the dashboard with an error message
            return redirect('/dashboard')->with('error', 'You have already completed the ' . $dbSection . ' assessment.');
        }

        // 3. Fetch the correct active questions (Only runs if they haven't taken it)
        $questions = Question::where('year_level', $user->year_level)
            ->where('section', $dbSection)
            ->where('is_active', true) // <--- ADD THIS LINE
            ->with('options')
            ->get();

        return view('quiz.show', compact('questions', 'dbSection'));
    }

    public function submitQuiz(Request $request)
    {
        $score = 0;
        $totalQuestions = 0;
        $user = Auth::user();
        $detailedAnswers = [];
        $categoryStats = [];

        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'question_')) {
                $totalQuestions++;
                $selectedOption = Option::find($value);
                $question = $selectedOption ? $selectedOption->question : null;

                if ($question && $selectedOption) {
                    $section = $question->section;
                    if (!isset($categoryStats[$section])) {
                        $categoryStats[$section] = ['score' => 0, 'total' => 0];
                    }
                    $categoryStats[$section]['total']++;

                    $isCorrect = (bool) $selectedOption->is_correct;
                    if ($isCorrect) {
                        $score++;
                        $categoryStats[$section]['score']++;
                    }

                    $correctOption = $question->options()->where('is_correct', 1)->first();

                    $detailedAnswers[] = [
                        'question' => $question->question_text,
                        'section' => $section,
                        'student_answer' => $selectedOption->option_text,
                        'is_correct' => $isCorrect,
                        'correct_answer' => $correctOption ? $correctOption->option_text : 'Unknown'
                    ];
                }
            }
        }

        QuizResult::create([
            'user_id' => $user->id,
            'year_level' => $user->year_level,
            'section' => $request->input('section', 'General Assessment'),
            'score' => $score,
            'total_questions' => $totalQuestions,
        ]);

        $prediction = "Pending";
        $personalizedNote = "Could not generate personalized note at this time.";
        $categoryPercentages = [];
        $topCategory = 'Academic Performance';
        $topPct = 0;
        $secondCategory = 'Self-Efficacy';
        $secondPct = 0;
        $lowestCategory = 'Motivation';
        $lowestPct = 0;

        try {
            $mlResponse = Http::timeout(60)->post(env('PYTHON_SERVER_URL') . '/api/predict-readiness', [
                'score' => $score,
                'total_questions' => $totalQuestions,
                'category_scores' => $categoryStats,
                'detailed_answers' => $detailedAnswers
            ]);

            if ($mlResponse->successful()) {
                $mlData = $mlResponse->json();
                $prediction = $mlData['prediction'] ?? 'Unknown';
                $personalizedNote = $mlData['personalized_note'] ?? 'No note generated.';
                $categoryPercentages = $mlData['category_percentages'] ?? [];
                $topCategory = $mlData['top_category'] ?? 'Academic Performance';
                $topPct = $mlData['top_pct'] ?? 0;
                $secondCategory = $mlData['second_category'] ?? 'Self-Efficacy';
                $secondPct = $mlData['second_pct'] ?? 0;
                $lowestCategory = $mlData['lowest_category'] ?? 'Motivation';
                $lowestPct = $mlData['lowest_pct'] ?? 0;
            }
        } catch (\Exception $e) {
            dd($e->getMessage()); // This will pause the page and print the exact error string
        }

        return view('quiz.results', compact(
            'score',
            'totalQuestions',
            'prediction',
            'personalizedNote',
            'categoryPercentages',
            'topCategory',
            'topPct',
            'secondCategory',
            'secondPct',
            'lowestCategory',
            'lowestPct'
        ));
    }
}
