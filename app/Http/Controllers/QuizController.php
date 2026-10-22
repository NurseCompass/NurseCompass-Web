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

        if ($user->role === 'faculty') {
            return redirect()->route('dashboard')->with('error', 'Faculty members cannot take student assessments.');
        }

        $alreadyFinished = QuizResult::where('user_id', $user->id)
            ->where('year_level', $user->year_level)
            ->exists();

        if ($alreadyFinished) {
            return redirect('/dashboard')->with('error', 'You have already completed your assessment for this year.');
        }

        $questions = Question::where('year_level', $user->year_level)
            ->where('is_active', true)
            ->with('options')
            ->get();

        $groupedQuestions = $questions->groupBy('section');

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

        $alreadyFinished = QuizResult::where('user_id', $user->id)
            ->where('section', $dbSection)
            ->exists();

        if ($alreadyFinished) {
            return redirect('/dashboard')->with('error', 'You have already completed the ' . $dbSection . ' assessment.');
        }

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

        // 2. Batch fetch selected options & questions
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

        // 3. Category Percentage Shares (Guaranteed to sum to EXACTLY 100%)
        $categoryPercentages = [];
        foreach (['Academic Performance', 'Self-Efficacy', 'Initiative', 'Motivation'] as $cat) {
            $catScore = $categoryStats[$cat]['score'] ?? 0;
            $categoryPercentages[$cat] = $score > 0 ? round(($catScore / $score) * 100) : 0;
        }

        if ($score > 0) {
            $sum = array_sum($categoryPercentages);
            if ($sum !== 100 && $sum > 0) {
                arsort($categoryPercentages);
                $highestKey = array_key_first($categoryPercentages);
                $categoryPercentages[$highestKey] += (100 - $sum);
            }
        }

        arsort($categoryPercentages);
        $rankedCategories = array_keys($categoryPercentages);
        $topCategory = $rankedCategories[0] ?? 'Academic Performance';

        $overallPct = $totalQuestions > 0 ? round(($score / $totalQuestions) * 100) : 0;
        $prediction = $overallPct >= 75 ? "WORKFORCE READY" : "NOT YET READY";

        // Filter missed questions for AI context
        $incorrectAnswers = array_values(array_filter($detailedAnswers, fn($a) => !$a['is_correct']));
        $sampleAnswers = array_slice($incorrectAnswers, 0, 10);
        if (empty($sampleAnswers)) {
            $sampleAnswers = array_slice($detailedAnswers, 0, 5);
        }

        // 4. Call Python AI Server
        $personalizedNote = null;
        $assessmentInterpretation = null;

        try {
            $pythonUrl = env('PYTHON_SERVER_URL', 'http://127.0.0.1:5001');
            $endpoint = rtrim($pythonUrl, '/') . '/api/predict-readiness';

            $mlResponse = Http::timeout(20)->post($endpoint, [
                'score' => $score,
                'total_questions' => $totalQuestions,
                'category_scores' => $categoryStats,
                'detailed_answers' => $sampleAnswers,
                'year_level' => $user->year_level ?? '4th Year'
            ]);

            if ($mlResponse->successful()) {
                $mlData = $mlResponse->json();
                $prediction = $mlData['prediction'] ?? $prediction;
                $personalizedNote = $mlData['personalized_note'] ?? null;
                $assessmentInterpretation = $mlData['assessment_interpretation'] ?? null;
            }
        } catch (\Exception $e) {
            // ML Server offline fallback
        }

        // Smart Nursing Fallbacks
        $lowestCategory = end($rankedCategories) ?: 'Motivation';
        if (empty($personalizedNote)) {
            $personalizedNote = "Demonstrated strong clinical foundation in <b>{$topCategory} ({$categoryPercentages[$topCategory]}%)</b>. Shows solid potential for clinical rotations.";
        }
        if (empty($assessmentInterpretation)) {
            $assessmentInterpretation = "Evaluation highlights room for clinical growth in <b>{$lowestCategory} ({$categoryPercentages[$lowestCategory]}%)</b>. Focus on reviewing missed patient management scenarios and emergency procedures during lab practice.";
        }

        $combinedNotes = $personalizedNote . '|||' . $assessmentInterpretation;

        // 5. Save QuizResult to Database
        $quizResult = QuizResult::create([
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
            'personalized_note' => $combinedNotes,
        ]);

        return redirect()->route('quiz.result', $quizResult->id);
    }

    public function showResult(int|string $id)
    {
        $user = Auth::user();

        $result = QuizResult::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $score = $result->score;
        $totalQuestions = ($result->total_questions > 0) ? $result->total_questions : 32;

        // Read saved columns & normalize so 4 boxes sum to 100%
        $rawAcademic = (int) ($result->academic_performance ?? 0);
        $rawEfficacy = (int) ($result->self_efficacy ?? 0);
        $rawInitiative = (int) ($result->initiative ?? 0);
        $rawMotivation = (int) ($result->motivation ?? 0);

        $sum = $rawAcademic + $rawEfficacy + $rawInitiative + $rawMotivation;
        if ($sum > 0 && $sum !== 100) {
            $categoryPercentages = [
                'Academic Performance' => round(($rawAcademic / $sum) * 100),
                'Self-Efficacy' => round(($rawEfficacy / $sum) * 100),
                'Initiative' => round(($rawInitiative / $sum) * 100),
                'Motivation' => round(($rawMotivation / $sum) * 100),
            ];
            $newSum = array_sum($categoryPercentages);
            if ($newSum !== 100 && $newSum > 0) {
                arsort($categoryPercentages);
                $highestKey = array_key_first($categoryPercentages);
                $categoryPercentages[$highestKey] += (100 - $newSum);
            }
        } else {
            $categoryPercentages = [
                'Academic Performance' => $rawAcademic,
                'Self-Efficacy' => $rawEfficacy,
                'Initiative' => $rawInitiative,
                'Motivation' => $rawMotivation,
            ];
        }

        arsort($categoryPercentages);
        $keys = array_keys($categoryPercentages);

        $topCategory = $result->top_category ?? $keys[0];
        $topPct = $categoryPercentages[$topCategory] ?? 0;

        $secondCategory = $keys[1] ?? 'Self-Efficacy';
        $secondPct = $categoryPercentages[$secondCategory] ?? 0;

        $lowestCategory = end($keys) ?: 'Motivation';
        $lowestPct = $categoryPercentages[$lowestCategory] ?? 0;

        $prediction = $result->prediction ?? 'NOT YET READY';

        $personalizedNote = null;
        $assessmentInterpretation = null;

        if ($result->personalized_note) {
            $parts = explode('|||', $result->personalized_note);
            $personalizedNote = $parts[0] ?? null;
            $assessmentInterpretation = $parts[1] ?? null;
        }

        return view('quiz.results', [
            'result' => $result,
            'score' => $score,
            'totalQuestions' => $totalQuestions,
            'prediction' => $prediction,
            'personalizedNote' => $personalizedNote,
            'assessmentInterpretation' => $assessmentInterpretation,
            'categoryPercentages' => $categoryPercentages,
            'topCategory' => $topCategory,
            'topPct' => $topPct,
            'secondCategory' => $secondCategory,
            'secondPct' => $secondPct,
            'lowestCategory' => $lowestCategory,
            'lowestPct' => $lowestPct
        ]);
    }
}