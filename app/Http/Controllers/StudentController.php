<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\QuizResult;

class StudentController extends Controller
{
    public function assessmentHistory()
    {
        $user = Auth::user();

        $dbAssessments = QuizResult::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $assessments = $dbAssessments->map(function ($result) {
            $totalQuestions = ($result->total_questions && $result->total_questions > 0) ? $result->total_questions : 32;
            $overallPct = round(($result->score / $totalQuestions) * 100);

            $academic = $result->academic_performance > 0 ? $result->academic_performance : $overallPct;
            $efficacy = $result->self_efficacy > 0 ? $result->self_efficacy : $overallPct;
            $initiative = $result->initiative > 0 ? $result->initiative : $overallPct;
            $motivation = $result->motivation > 0 ? $result->motivation : $overallPct;

            $categories = [
                'Academic Performance' => $academic,
                'Self-Efficacy'        => $efficacy,
                'Initiative'           => $initiative,
                'Motivation'           => $motivation,
            ];
            arsort($categories);
            $topTrait = $result->top_category ?? array_key_first($categories);

            $title = $result->year_level ? ($result->year_level . ' Workforce Assessment') : '3rd Year Workforce Assessment';

            return [
                'id'                   => $result->id,
                'title'                => $title,
                'completed_at'         => $result->created_at ? $result->created_at->format('F d, Y') : 'Recently',
                'score'                => $result->score,
                'total'                => $totalQuestions,
                'top_trait'            => $topTrait,
                'academic_performance' => $academic,
                'self_efficacy'        => $efficacy,
                'initiative'           => $initiative,
                'motivation'           => $motivation,
            ];
        });

        return view('student.assessment-history', compact('assessments'));
    }
}
