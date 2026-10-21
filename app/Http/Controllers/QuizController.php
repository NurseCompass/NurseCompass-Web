<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Option;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
            ->where('is_active', true)
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
            'self-efficacy' => 'Self-Efficacy',
            'initiative' => 'Initiative',
            'motivation' => 'Motivation',
        ];

        if (!array_key_exists($slug, $sections)) {
            abort(404);
        }

        $dbSection = $sections[$slug];
        $user = request()->user();

        // Check if they already took this exact section
        $alreadyFinished = QuizResult::where('user_id', $user->id)
            ->where('section', $dbSection)
            ->exists();

        if ($alreadyFinished) {
            return redirect('/dashboard')->with('error', 'You have already completed the ' . $dbSection . ' assessment.');
        }

        // Fetch the correct active questions
        $questions = Question::where('year_level', $user->year_level)
            ->where('section', $dbSection)
            ->where('is_active', true)
            ->with('options')
            ->get();

        return view('quiz.show', compact('questions', 'dbSection'));
    }

    public function submitQuiz(Request $request)
    {
        $user = Auth::user();

        // 1. Collect submitted option IDs
        $optionIds = [];
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'question_') && !empty($value)) {
                $optionIds[] = $value;
            }
        }

        // 2. BATCH FETCH: 1 fast SQL query for all selected options, questions, and answers
        $selectedOptions = Option::whereIn('id', $optionIds)
            ->with(['question.options'])
            ->get();

        $score = 0;
        $totalQuestions = count($selectedOptions);
        $detailedAnswers = [];
        $categoryStats = [];

        foreach ($selectedOptions as $selectedOption) {
            $question = $selectedOption->question;
            if (!$question)
                continue;

            $section = $question->section ?? 'General Assessment';
            if (!isset($categoryStats[$section])) {
                $categoryStats[$section] = ['score' => 0, 'total' => 0];
            }
            $categoryStats[$section]['total']++;

            $isCorrect = (bool) $selectedOption->is_correct;
            if ($isCorrect) {
                $score++;
                $categoryStats[$section]['score']++;
            }

            $correctOption = $question->options->firstWhere('is_correct', 1);

            $detailedAnswers[] = [
                'question' => $question->question_text,
                'section' => $section,
                'student_answer' => $selectedOption->option_text,
                'is_correct' => $isCorrect,
                'correct_answer' => $correctOption ? $correctOption->option_text : 'Unknown'
            ];
        }

        // 3. Instant Category Percentages in PHP (Fixes 0% display bug)
        $categoryPercentages = [];
        foreach (['Academic Performance', 'Self-Efficacy', 'Initiative', 'Motivation'] as $cat) {
            $catScore = $categoryStats[$cat]['score'] ?? 0;
            $catTotal = $categoryStats[$cat]['total'] ?? 0;
            $categoryPercentages[$cat] = $catTotal > 0 ? round(($catScore / $catTotal) * 100) : 0;
        }

        arsort($categoryPercentages);
        $rankedCategories = array_keys($categoryPercentages);

        $topCategory = $rankedCategories[0] ?? 'Academic Performance';
        $topPct = $categoryPercentages[$topCategory];

        $secondCategory = $rankedCategories[1] ?? 'Self-Efficacy';
        $secondPct = $categoryPercentages[$secondCategory];

        $lowestCategory = end($rankedCategories) ?: 'Motivation';
        $lowestPct = $categoryPercentages[$lowestCategory];

        $overallPct = $totalQuestions > 0 ? round(($score / $totalQuestions) * 100) : 0;
        $prediction = $overallPct >= 75 ? "Workforce Ready" : "Needs Improvement";
        $personalizedNote = "Your assessment score has been recorded successfully.";

        // 4. Send compact sample (max 10 missed questions) so Llama responds in ~5 seconds
        $incorrectAnswers = array_values(array_filter($detailedAnswers, fn($a) => !$a['is_correct']));
        $sampleAnswers = array_slice($incorrectAnswers, 0, 10);
        if (empty($sampleAnswers)) {
            $sampleAnswers = array_slice($detailedAnswers, 0, 5);
        }

        try {
            $pythonUrl = env('PYTHON_SERVER_URL', 'http://127.0.0.1:5001');
            $endpoint = rtrim($pythonUrl, '/') . '/api/predict-readiness';

            $mlResponse = Http::timeout(60)->post('http://127.0.0.1:5001/api/predict-readiness', [
                'score' => $score,
                'total_questions' => $totalQuestions,
                'category_scores' => $categoryStats,
                'detailed_answers' => $sampleAnswers
            ]);

            if ($mlResponse->successful()) {
                $mlData = $mlResponse->json();
                $prediction = $mlData['prediction'] ?? $prediction;
                $personalizedNote = $mlData['personalized_note'] ?? $personalizedNote;
            }
        } catch (\Exception $e) {
            // Fallback gracefully
        }

        // 5. Save complete breakdown directly into MySQL database
        QuizResult::create([
            'user_id' => $user->id,
            'year_level' => $user->year_level,
            'section' => $request->input('section', 'Comprehensive'),
            'score' => $score,
            'total_questions' => $totalQuestions,
            'academic_performance' => $categoryPercentages['Academic Performance'],
            'self_efficacy' => $categoryPercentages['Self-Efficacy'],
            'initiative' => $categoryPercentages['Initiative'],
            'motivation' => $categoryPercentages['Motivation'],
            'top_category' => $topCategory,
            'prediction' => $prediction,
            'personalized_note' => $personalizedNote,
        ]);

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
    /**
     * Show detailed result view for a specific historical assessment
     *
     * @param int|string $id
     */
    public function showResult(int|string $id)
    {
        $user = Auth::user();

        $result = QuizResult::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $score = $result->score;
        $totalQuestions = ($result->total_questions > 0) ? $result->total_questions : 32;
        $overallPct = round(($score / $totalQuestions) * 100);

        // Read saved columns or fallback to overall average if viewing old test runs
        $categoryPercentages = [
            'Academic Performance' => $result->academic_performance > 0 ? $result->academic_performance : $overallPct,
            'Self-Efficacy' => $result->self_efficacy > 0 ? $result->self_efficacy : $overallPct,
            'Initiative' => $result->initiative > 0 ? $result->initiative : $overallPct,
            'Motivation' => $result->motivation > 0 ? $result->motivation : $overallPct,
        ];

        arsort($categoryPercentages);
        $keys = array_keys($categoryPercentages);

        $topCategory = $result->top_category ?? $keys[0];
        $topPct = $categoryPercentages[$topCategory];

        $secondCategory = $keys[1] ?? 'Self-Efficacy';
        $secondPct = $categoryPercentages[$secondCategory];

        $lowestCategory = end($keys) ?: 'Initiative';
        $lowestPct = $categoryPercentages[$lowestCategory];

        $prediction = $result->prediction ?? 'Ready for Practice';
        $personalizedNote = $result->personalized_note ?? 'Your foundations in this domain are exceptionally solid.';

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
