<x-app-layout>
    <!-- Moved the header out of x-slot to bypass the dark mode wrapper in app.blade.php -->
    <div class="bg-[#FCD34D] border-b border-yellow-500 shadow-sm">
        <div class="max-w-5xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
            <h2 class="font-extrabold text-2xl text-red-800 tracking-tight">
                {{ __('Assessment Portal') }}
            </h2>
        </div>
    </div>

    <div class="py-10 bg-[#F8F9FA] min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Welcome Banner -->
            <div class="bg-[#FCD34D] rounded-xl shadow-[0_4px_14px_0_rgba(0,0,0,0.1)] p-6 lg:p-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div>
                    <span class="bg-red-800 text-white text-xs font-bold uppercase tracking-wider px-4 py-1.5 rounded-full inline-block mb-3">Student Portal</span>
                    <h1 class="text-2xl lg:text-3xl font-bold text-red-800">Welcome Back, {{ auth()->user()->name ?? 'Student Name' }}!</h1>
                    <p class="text-red-900/80 text-sm mt-1.5 font-medium">Track your predictive workforce readiness assessments, monitor milestones, and view progress.</p>
                </div>
                
                <div class="bg-white/60 backdrop-blur-sm border border-yellow-500/30 rounded-xl p-4 text-center shrink-0 min-w-[150px]">
                    <span class="text-[10px] uppercase tracking-wider font-extrabold text-red-800 block mb-1">Current Year Level</span>
                    <span class="text-2xl font-black text-red-800">
                        {{ auth()->user()->year_level ?? 'N/A' }}
                        @if(is_numeric(auth()->user()->year_level))
                            @if(auth()->user()->year_level == 1)st
                            @elseif(auth()->user()->year_level == 2)nd
                            @elseif(auth()->user()->year_level == 3)rd
                            @else th
                            @endif
                            Year
                        @endif
                    </span>
                </div>
            </div>

            <!-- Assessments Section -->
            <div class="bg-white rounded-xl shadow-[0_4px_14px_0_rgba(0,0,0,0.05)] border border-gray-200 p-6 lg:p-8">
                <div class="mb-6 border-b border-gray-100 pb-4">
                    <h3 class="text-xl font-bold text-red-800 mb-1">Available & Upcoming Assessments</h3>
                    <p class="text-gray-500 text-sm font-medium">Complete your targeted year-level evaluation to generate your workforce readiness metrics.</p>
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
                    <div class="bg-white border rounded-xl p-6 flex flex-col justify-between {{ $userYear == 3 ? 'border-[#FCD34D] ring-1 ring-[#FCD34D]' : 'border-gray-200' }}">
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="font-bold text-lg text-red-800">3rd Year Assessment</h4>
                                @if($userYear == 3 && !$hasFinishedAssessment)
                                <span class="bg-[#059669] text-white text-xs font-bold px-3 py-1 rounded-full">Available</span>
                                @elseif($userYear > 3 || ($userYear == 3 && $hasFinishedAssessment))
                                <span class="bg-gray-200 text-gray-700 text-xs font-bold px-3 py-1 rounded-full">Completed</span>
                                @else
                                <span class="bg-[#FCD34D] text-red-900 text-xs font-bold px-3 py-1 rounded-full">Locked</span>
                                @endif
                            </div>
                            <p class="text-gray-500 text-sm mb-6 leading-relaxed">Comprehensive junior-level evaluation focusing on clinical reasoning, patient care foundations, and core safety standards.</p>
                        </div>

                        <div>
                            @if($userYear == 3 && !$hasFinishedAssessment)
                            <a href="/quiz/take" class="block w-full text-center bg-[#FCD34D] hover:bg-yellow-400 text-red-900 font-bold py-3 rounded-lg transition shadow-sm">
                                Start Assessment
                            </a>
                            @elseif($userYear > 3 || ($userYear == 3 && $hasFinishedAssessment))
                            <div class="w-full text-center bg-gray-100 text-gray-500 font-bold py-3 rounded-lg cursor-not-allowed border border-gray-200">
                                Completed
                            </div>
                            @else
                            <button disabled class="w-full text-center bg-gray-200 text-gray-500 font-bold py-3 rounded-lg cursor-not-allowed border border-gray-200">
                                Unlocks in 3rd Year
                            </button>
                            @endif
                        </div>
                    </div>

                    <!-- 4th Year Assessment Card -->
                    <div class="bg-white border rounded-xl p-6 flex flex-col justify-between {{ $userYear == 4 ? 'border-[#FCD34D] ring-1 ring-[#FCD34D]' : 'border-gray-200' }}">
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="font-bold text-lg text-red-800">4th Year Assessment</h4>
                                @if($userYear == 4 && !$hasFinishedAssessment)
                                <span class="bg-[#059669] text-white text-xs font-bold px-3 py-1 rounded-full">Available</span>
                                @elseif($userYear > 4 || ($userYear == 4 && $hasFinishedAssessment))
                                <span class="bg-gray-200 text-gray-700 text-xs font-bold px-3 py-1 rounded-full">Completed</span>
                                @else
                                <span class="bg-[#FCD34D] text-red-900 text-xs font-bold px-3 py-1 rounded-full">Locked</span>
                                @endif
                            </div>
                            <p class="text-gray-500 text-sm mb-6 leading-relaxed">Advanced senior-level evaluation focusing on leadership, critical clinical decision-making, and professional nursing integration.</p>
                        </div>

                        <div>
                            @if($userYear == 4 && !$hasFinishedAssessment)
                            <a href="/quiz/take" class="block w-full text-center bg-[#FCD34D] hover:bg-yellow-400 text-red-900 font-bold py-3 rounded-lg transition shadow-sm">
                                Start Assessment
                            </a>
                            @elseif($userYear > 4 || ($userYear == 4 && $hasFinishedAssessment))
                            <div class="w-full text-center bg-gray-100 text-gray-500 font-bold py-3 rounded-lg cursor-not-allowed border border-gray-200">
                                Completed
                            </div>
                            @else
                            <button disabled class="w-full text-center bg-gray-200 text-gray-500 font-bold py-3 rounded-lg cursor-not-allowed border border-gray-200">
                                Unlocks in 4th Year
                            </button>
                            @endif
                        </div>
                    </div>

                </div>
                @else
                <div class="p-5 bg-yellow-50 text-yellow-800 border border-yellow-200 rounded-xl font-medium text-sm">
                    Please update your profile with your correct Year Level to unlock your specific assessment modules.
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>