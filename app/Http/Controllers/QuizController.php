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
        // 1. Map the URL slug to the database section name
        $sections = [
            'academic-performance' => 'Academic Performance',
            'self-efficacy'        => 'Self-Efficacy',
            'initiative'           => 'Initiative',
            'motivation'           => 'Motivation',
        ];

        // 2. If the user types a random URL, throw a 404 error
        if (!array_key_exists($slug, $sections)) {
            abort(404);
        }

        $dbSection = $sections[$slug];
        $yearLevel = Auth::user()->year_level; // Automatically gets '3rd Year' or '4th Year'

        // 3. Fetch the correct questions
        $questions = Question::where('year_level', $yearLevel)
            ->where('section', $dbSection)
            ->with('options')
            ->get();

        // 4. Return a generic view (we will rename your blade file next)
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
