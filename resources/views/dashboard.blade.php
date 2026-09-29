<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Assessment Portal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-teal-600 to-teal-800 text-white rounded-2xl shadow-xl p-6 lg:p-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <span class="bg-teal-500/30 text-teal-100 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full">Student Portal</span>
                    <h1 class="text-2xl lg:text-3xl font-black mt-2">Welcome back, {{ auth()->user()->name ?? 'Student' }}!</h1>
                    <p class="text-teal-100 text-sm mt-1">Track your predictive workforce readiness assessments, monitor milestones, and view progress.</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-4 text-center shrink-0">
                    <span class="text-xs uppercase tracking-wider font-semibold text-teal-200 block">Current Year Level</span>
                    <span class="text-2xl font-black text-white">{{ auth()->user()->year_level ?? 'N/A' }}</span>
                </div>
            </div>

            <!-- Assessments Section -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-200 p-6 lg:p-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-900">Available & Upcoming Assessments</h3>
                        <p class="text-slate-500 text-sm">Complete your targeted year-level evaluation to generate your workforce readiness metrics.</p>
                    </div>
                </div>

                @php
                $yearString = auth()->user()->year_level ?? '0';
                $userYear = (int) filter_var($yearString, FILTER_SANITIZE_NUMBER_INT);

                $hasFinishedAssessment = \App\Models\QuizResult::where('user_id', auth()->id())
                ->where('year_level', $yearString)
                ->exists();
                @endphp

                @if($userYear >= 1)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- 3rd Year Assessment Card -->
                    <div class="bg-slate-50 border {{ $userYear == 3 ? 'border-teal-300 ring-2 ring-teal-100' : 'border-slate-200' }} rounded-xl p-6 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-center mb-3">
                                <h4 class="font-extrabold text-lg text-slate-900">3rd Year Assessment</h4>
                                @if($userYear == 3 && !$hasFinishedAssessment)
                                <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full">Available</span>
                                @elseif($userYear > 3 || ($userYear == 3 && $hasFinishedAssessment))
                                <span class="bg-slate-200 text-slate-700 text-xs font-bold px-3 py-1 rounded-full">Completed</span>
                                @else
                                <span class="bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1 rounded-full">Locked</span>
                                @endif
                            </div>
                            <p class="text-slate-600 text-sm mb-6 leading-relaxed">Comprehensive junior-level evaluation focusing on clinical reasoning, patient care foundations, and core safety standards.</p>
                        </div>

                        <div>
                            @if($userYear == 3 && !$hasFinishedAssessment)
                            <a href="/quiz/take" class="block w-full text-center bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 rounded-xl transition shadow-md hover:shadow-lg">
                                Start Assessment
                            </a>
                            @elseif($userYear > 3 || ($userYear == 3 && $hasFinishedAssessment))
                            <div class="w-full text-center bg-slate-200 text-slate-500 font-bold py-3 rounded-xl cursor-not-allowed">
                                Completed Successfully
                            </div>
                            @else
                            <button disabled class="w-full text-center bg-slate-100 text-slate-400 font-bold py-3 rounded-xl cursor-not-allowed opacity-60">
                                Unlocks in 3rd Year
                            </button>
                            @endif
                        </div>
                    </div>

                    <!-- 4th Year Assessment Card -->
                    <div class="bg-slate-50 border {{ $userYear == 4 ? 'border-teal-300 ring-2 ring-teal-100' : 'border-slate-200' }} rounded-xl p-6 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-center mb-3">
                                <h4 class="font-extrabold text-lg text-slate-900">4th Year Assessment</h4>
                                @if($userYear == 4 && !$hasFinishedAssessment)
                                <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full">Available</span>
                                @elseif($userYear > 4 || ($userYear == 4 && $hasFinishedAssessment))
                                <span class="bg-slate-200 text-slate-700 text-xs font-bold px-3 py-1 rounded-full">Completed</span>
                                @else
                                <span class="bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1 rounded-full">Locked</span>
                                @endif
                            </div>
                            <p class="text-slate-600 text-sm mb-6 leading-relaxed">Advanced senior-level evaluation focusing on leadership, critical clinical decision-making, and professional nursing integration.</p>
                        </div>

                        <div>
                            @if($userYear == 4 && !$hasFinishedAssessment)
                            <a href="/quiz/take" class="block w-full text-center bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 rounded-xl transition shadow-md hover:shadow-lg">
                                Start Assessment
                            </a>
                            @elseif($userYear > 4 || ($userYear == 4 && $hasFinishedAssessment))
                            <div class="w-full text-center bg-slate-200 text-slate-500 font-bold py-3 rounded-xl cursor-not-allowed">
                                Completed Successfully
                            </div>
                            @else
                            <button disabled class="w-full text-center bg-slate-100 text-slate-400 font-bold py-3 rounded-xl cursor-not-allowed opacity-60">
                                Unlocks in 4th Year
                            </button>
                            @endif
                        </div>
                    </div>

                </div>
                @else
                <div class="p-5 bg-amber-50 text-amber-800 border border-amber-200 rounded-xl font-medium text-sm">
                    Please update your profile with your correct Year Level to unlock your specific assessment modules.
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>