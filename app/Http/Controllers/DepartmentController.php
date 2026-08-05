<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\QuizResult;
use App\Models\Section;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        // 1. Get overall metrics for the Dean's overview
        $totalStudents = User::where('role', 'student')->count();
        $totalQuizzesTaken = QuizResult::count();
        
        // 2. Calculate average score across all quiz results
        $averageScore = QuizResult::avg('score') ?? 0;

        // 3. Get section-by-section breakdown for performance analysis
        $sections = Section::withCount('students')->get();

        // 4. Pass metrics to the dean's dashboard view
        return view('department.dashboard', compact(
            'totalStudents',
            'totalQuizzesTaken',
            'averageScore',
            'sections'
        ));
    }
}