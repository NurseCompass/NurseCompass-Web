<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Option;
use App\Models\QuizResult; // Add this
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this

class QuizController extends Controller
{
    public function showQuiz($slug)
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
        $user = auth()->user();

        // THE NEW BLOCKADE: Check if they already took this exact section
        $alreadyFinished = QuizResult::where('user_id', $user->id)
            ->where('section', $dbSection)
            ->exists();

        if ($alreadyFinished) {
            // Kick them back to the dashboard with an error message
            return redirect('/dashboard')->with('error', 'You have already completed the ' . $dbSection . ' assessment.');
        }

        // 3. Fetch the correct questions (Only runs if they haven't taken it)
        $questions = Question::where('year_level', $user->year_level)
            ->where('section', $dbSection)
            ->with('options')
            ->get();

        return view('quiz.show', compact('questions', 'dbSection'));
    }

    public function submitQuiz(Request $request)
    {
        $score = 0;
        $totalQuestions = 0;
        $user = Auth::user(); // Get the logged-in user

        // Loop through everything submitted in the form
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'question_')) {
                $totalQuestions++;
                $selectedOption = Option::find($value);

                if ($selectedOption && $selectedOption->is_correct) {
                    $score++;
                }
            }
        }

        // SAVE TO DATABASE DYNAMICALLY
        QuizResult::create([
            'user_id' => $user->id,
            'year_level' => $user->year_level, // Grabs from the logged-in user
            'section' => $request->input('section'), // We will pass this from the view!
            'score' => $score,
            'total_questions' => $totalQuestions,
        ]);

        return view('quiz.results', compact('score', 'totalQuestions'));
    }
}
