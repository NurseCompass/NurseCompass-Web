<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('welcome');
});

// Group all routes that require the user to be logged in
// ==========================================
// GROUP 1: EVERYBODY (Students, Faculty, Admin)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // Everyone needs to be able to edit their own profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});


// ==========================================
// GROUP 2: STUDENTS ONLY
// ==========================================
Route::middleware(['auth', CheckRole::class . ':student'])->group(function () {
    
    // --- STUDENT DASHBOARD ---
    Route::get('/dashboard', function () {
        $user = request()->user();
        $results = App\Models\QuizResult::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $completedSections = $results->pluck('section')->toArray();
        
        return view('dashboard', compact('user', 'results', 'completedSections'));
    })->middleware(['verified'])->name('dashboard');

    // --- STUDENT ONBOARDING ---
    Route::get('/onboarding', function () {
        return view('onboarding');
    });
    
    Route::post('/onboarding', function (\Illuminate\Http\Request $request) {
        $user = $request->user();
        $validated = $request->validate([
            'student_number' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'year_level' => 'required|string',
        ]);
        $user->update($validated);
        return redirect('/dashboard');
    });

    // --- QUIZ ROUTES ---
    Route::get('/quiz/take', [App\Http\Controllers\QuizController::class, 'takeQuiz']);
    Route::post('/submit-quiz', [App\Http\Controllers\QuizController::class, 'submitQuiz']);
    Route::get('/quiz/{slug}', [App\Http\Controllers\QuizController::class, 'showQuiz']);
    Route::post('/quiz/submit', [App\Http\Controllers\QuizController::class, 'submitQuiz']);

    // --- STUDY MATERIALS ---
    Route::get('/study-materials', [App\Http\Controllers\ReviewerController::class, 'index'])->name('reviewers.index');
    Route::post('/study-materials', [App\Http\Controllers\ReviewerController::class, 'store'])->name('reviewers.store');
    Route::get('/study-materials/{reviewer}/edit', [App\Http\Controllers\ReviewerController::class, 'edit'])->name('reviewers.edit');
    Route::put('/study-materials/{reviewer}', [App\Http\Controllers\ReviewerController::class, 'update'])->name('reviewers.update');

});

// --- STUDENT ROUTES ---
// (Your existing /dashboard and /quiz routes go here)


// --- FACULTY ROUTES ---
Route::middleware(['auth', CheckRole::class . ':faculty'])->group(function () {
    Route::get('/faculty/dashboard', function () {
        return view('faculty.dashboard'); // You will create this blade file later
    })->name('faculty.dashboard');

    // Add routes here for viewing student clinical performance ratings
});


// --- DEPARTMENT HEAD ROUTES ---
Route::middleware(['auth', CheckRole::class . ':department_head'])->group(function () {
    Route::get('/department/dashboard', [App\Http\Controllers\DepartmentController::class, 'index'])->name('department.dashboard');
});

// --- ADMIN / SYSTEM ADMINISTRATOR ROUTES ---
Route::middleware(['auth', App\Http\Middleware\CheckRole::class . ':admin'])->group(function () {
    
    // The Admin Dashboard View
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('admin.dashboard'); // <-- THIS IS THE MISSING PIECE!

    // The CSV Import Route
    Route::post('/admin/import-students', [App\Http\Controllers\AdminController::class, 'importStudents'])->name('admin.import.students');
    
});

require __DIR__ . '/auth.php';
