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
            'self-efficacy'        => 'Self-Efficacy',
            'initiative'           => 'Initiative',
            'motivation'           => 'Motivation',
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

        // 1. Calculate individual category percentages from submitted questions
        $academicPct = isset($categoryStats['Academic Performance']) && $categoryStats['Academic Performance']['total'] > 0
            ? round(($categoryStats['Academic Performance']['score'] / $categoryStats['Academic Performance']['total']) * 100) : 0;

        $efficacyPct = isset($categoryStats['Self-Efficacy']) && $categoryStats['Self-Efficacy']['total'] > 0
            ? round(($categoryStats['Self-Efficacy']['score'] / $categoryStats['Self-Efficacy']['total']) * 100) : 0;

        $initiativePct = isset($categoryStats['Initiative']) && $categoryStats['Initiative']['total'] > 0
            ? round(($categoryStats['Initiative']['score'] / $categoryStats['Initiative']['total']) * 100) : 0;

        $motivationPct = isset($categoryStats['Motivation']) && $categoryStats['Motivation']['total'] > 0
            ? round(($categoryStats['Motivation']['score'] / $categoryStats['Motivation']['total']) * 100) : 0;

        $prediction = "Pending";
        $personalizedNote = "Could not generate personalized note at this time.";
        $categoryPercentages = [
            'Academic Performance' => $academicPct,
            'Self-Efficacy'        => $efficacyPct,
            'Initiative'           => $initiativePct,
            'Motivation'           => $motivationPct,
        ];

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
                if (!empty($mlData['category_percentages'])) {
                    $categoryPercentages = $mlData['category_percentages'];
                    $academicPct = $categoryPercentages['Academic Performance'] ?? $academicPct;
                    $efficacyPct = $categoryPercentages['Self-Efficacy'] ?? $efficacyPct;
                    $initiativePct = $categoryPercentages['Initiative'] ?? $initiativePct;
                    $motivationPct = $categoryPercentages['Motivation'] ?? $motivationPct;
                }
                $topCategory = $mlData['top_category'] ?? 'Academic Performance';
                $topPct = $mlData['top_pct'] ?? 0;
                $secondCategory = $mlData['second_category'] ?? 'Self-Efficacy';
                $secondPct = $mlData['second_pct'] ?? 0;
                $lowestCategory = $mlData['lowest_category'] ?? 'Motivation';
                $lowestPct = $mlData['lowest_pct'] ?? 0;
            }
        } catch (\Exception $e) {
            // ML server fallback
        }

        // 2. Save complete breakdown directly into MySQL database
        QuizResult::create([
            'user_id'              => $user->id,
            'year_level'           => $user->year_level,
            'section'              => $request->input('section', 'Comprehensive'),
            'score'                => $score,
            'total_questions'      => $totalQuestions,
            'academic_performance' => $academicPct,
            'self_efficacy'        => $efficacyPct,
            'initiative'           => $initiativePct,
            'motivation'           => $motivationPct,
            'top_category'         => $topCategory,
            'prediction'           => $prediction,
            'personalized_note'    => $personalizedNote,
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
            'Self-Efficacy'        => $result->self_efficacy > 0 ? $result->self_efficacy : $overallPct,
            'Initiative'           => $result->initiative > 0 ? $result->initiative : $overallPct,
            'Motivation'           => $result->motivation > 0 ? $result->motivation : $overallPct,
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
