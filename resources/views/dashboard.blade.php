<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Assessment Portal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Track your assessments and progress</p>
            </div>

            <div class="bg-teal-50 dark:bg-teal-900 overflow-hidden shadow-sm sm:rounded-xl border border-teal-200 mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-teal-900 dark:text-teal-50">Welcome, {{ auth()->user()->name ?? 'Student' }}</h3>
                    <p class="mt-1 text-sm text-teal-700 dark:text-teal-200">Your Predictive Workforce Readiness System metrics will populate here upon assessment completion.</p>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="flex items-center text-lg font-semibold text-blue-600 dark:text-blue-400 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Available & Upcoming Assessments
                </h3>

                @php
                // Safely extract the integer from strings like "3rd Year" or "4th Year"
                $yearString = auth()->user()->year_level ?? '0';
                $userYear = (int) filter_var($yearString, FILTER_SANITIZE_NUMBER_INT);

                // THE FIX: Check the database to see if they finished the test SPECIFICALLY for their current year level
                $hasFinishedAssessment = \App\Models\QuizResult::where('user_id', auth()->id())
                ->where('year_level', $yearString)
                ->exists();
                @endphp

                @if($userYear >= 1)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- 3rd Year Assessment Card -->
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-5 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="font-bold text-lg text-gray-900 dark:text-gray-100">3rd Year Assessment</h4>
                                @if($userYear == 3 && !$hasFinishedAssessment)
                                <span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Available</span>
                                @elseif($userYear > 3 || ($userYear == 3 && $hasFinishedAssessment))
                                <span class="bg-gray-100 text-gray-800 text-xs font-bold px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Completed</span>
                                @else
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Locked</span>
                                @endif
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">BSIT Junior Level Evaluation (Comprehensive)</p>
                        </div>

                        @if($userYear == 3 && !$hasFinishedAssessment)
                        <a href="/quiz/take" class="block w-full text-center bg-gray-900 hover:bg-black dark:bg-gray-100 dark:hover:bg-white dark:text-gray-900 text-white font-semibold py-2.5 rounded-lg transition duration-150">
                            Start Assessment
                        </a>
                        @elseif($userYear > 3 || ($userYear == 3 && $hasFinishedAssessment))
                        <div class="w-full text-center bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 font-semibold py-2.5 rounded-lg cursor-not-allowed">
                            Completed
                        </div>
                        @else
                        <button disabled class="w-full text-center bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 font-semibold py-2.5 rounded-lg cursor-not-allowed opacity-50">
                            Unlocks in 3rd Year
                        </button>
                        @endif
                    </div>

                    <!-- 4th Year Assessment Card -->
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-5 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="font-bold text-lg text-gray-900 dark:text-gray-100">4th Year Assessment</h4>
                                @if($userYear == 4 && !$hasFinishedAssessment)
                                <span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Available</span>
                                @elseif($userYear > 4 || ($userYear == 4 && $hasFinishedAssessment))
                                <span class="bg-gray-100 text-gray-800 text-xs font-bold px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Completed</span>
                                @else
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Locked</span>
                                @endif
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">BSIT Senior Level Evaluation (Comprehensive)</p>
                        </div>

                        @if($userYear == 4 && !$hasFinishedAssessment)
                        <a href="/quiz/take" class="block w-full text-center bg-gray-900 hover:bg-black dark:bg-gray-100 dark:hover:bg-white dark:text-gray-900 text-white font-semibold py-2.5 rounded-lg transition duration-150">
                            Start Assessment
                        </a>
                        @elseif($userYear > 4 || ($userYear == 4 && $hasFinishedAssessment))
                        <div class="w-full text-center bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 font-semibold py-2.5 rounded-lg cursor-not-allowed">
                            Completed
                        </div>
                        @else
                        <button disabled class="w-full text-center bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 font-semibold py-2.5 rounded-lg cursor-not-allowed opacity-50">
                            Unlocks in 4th Year
                        </button>
                        @endif
                    </div>

                </div>
                @else
                <div class="p-4 bg-yellow-50 text-yellow-700 border border-yellow-200 rounded-lg shadow-sm font-medium">
                    Please update your profile with your Year Level to unlock your specific assessment modules.
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>