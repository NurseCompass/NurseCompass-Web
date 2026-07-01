<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    // Fetch all quiz results for this specific user
    $results = QuizResult::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('dashboard', compact('user', 'results'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// web.php

Route::middleware(['auth'])->group(function () {
    // Grouped routes under auth
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Onboarding routes
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

    // Profile routes...
});

// routes/web.php

Route::middleware(['auth'])->group(function () {
    // ... your other routes ...

    Route::get('/quiz/{slug}', [QuizController::class, 'showQuiz']);
    Route::post('/quiz/submit', [QuizController::class, 'submitQuiz']);
});

require __DIR__ . '/auth.php';
