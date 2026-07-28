<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('welcome');
});

// Group all routes that require the user to be logged in
Route::middleware(['auth'])->group(function () {

    // --- DASHBOARD ROUTE ---
    Route::get('/dashboard', function () {
        $user = request()->user();

        // 1. Fetch their past results
        $results = QuizResult::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // 2. Create the array of finished sections
        $completedSections = $results->pluck('section')->toArray();

        // 3. Pass EVERYTHING to the view
        return view('dashboard', compact('user', 'results', 'completedSections'));
    })->middleware(['verified'])->name('dashboard');


    // --- ONBOARDING ROUTES ---
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
    Route::get('/quiz/{slug}', [QuizController::class, 'showQuiz']);
    Route::post('/quiz/submit', [QuizController::class, 'submitQuiz']);

    Route::get('/study-materials', [App\Http\Controllers\ReviewerController::class, 'index'])->name('reviewers.index');
    Route::post('/study-materials', [App\Http\Controllers\ReviewerController::class, 'store'])->name('reviewers.store');
    Route::get('/study-materials/{reviewer}/edit', [App\Http\Controllers\ReviewerController::class, 'edit'])->name('reviewers.edit');
    Route::put('/study-materials/{reviewer}', [App\Http\Controllers\ReviewerController::class, 'update'])->name('reviewers.update');


    // --- PROFILE ROUTES ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
    Route::get('/department/dashboard', function () {
        return view('department.dashboard'); // You will create this blade file later
    })->name('department.dashboard');

    // Add routes here for viewing the analytics dashboard reports
});

require __DIR__ . '/auth.php';
