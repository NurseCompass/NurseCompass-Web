<x-app-layout>
    @php
        /** @var string $topCategory */
        /** @var int|float $topPct */
        /** @var string $secondCategory */
        /** @var int|float $secondPct */
        /** @var string $lowestCategory */
        /** @var int|float $lowestPct */
        /** @var array $categoryPercentages */
        /** @var int|string $score */
        /** @var int|string $totalQuestions */
        /** @var string $personalizedNote */

        $topCategory = $topCategory ?? 'Academic Performance';
        $topPct = $topPct ?? 0;
        $secondCategory = $secondCategory ?? 'Self-Efficacy';
        $secondPct = $secondPct ?? 0;
        $lowestCategory = $lowestCategory ?? 'Motivation';
        $lowestPct = $lowestPct ?? 0;
        $categoryPercentages = $categoryPercentages ?? [];
    @endphp

    <!-- 1. The Header Banner (Full-width styling) -->
    <div class="bg-[#FCD34D] w-full py-4 border-b border-[#F59E0B]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-extrabold text-2xl md:text-3xl text-[#B91C1C] leading-tight tracking-wide">
                Comprehensive Assessment
            </h1>
        </div>
    </div>

    <!-- 2. Main Content Area -->
    <div class="py-10 bg-white min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <!-- Assessment Container -->
            <div class="bg-white rounded-3xl border-2 border-gray-200 p-8 lg:p-10 flex flex-col shadow-sm">

                <!-- Title -->
                <h2 class="text-3xl font-extrabold text-[#B91C1C] text-center mb-8">Assessment Complete!</h2>

                <!-- 2-Column Layout Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 flex-grow">

                    <!-- LEFT COLUMN -->
                    <div class="flex flex-col gap-6">

                        <!-- Score Block -->
                        <div
                            class="bg-white border-2 border-gray-200 rounded-2xl p-6 text-center flex flex-col justify-center items-center h-36">
                            <p class="text-[#B91C1C] font-bold uppercase tracking-widest text-[11px] mb-2">Your Score
                            </p>
                            <div class="text-5xl font-black text-[#0F5132]">
                                {{ $score }}<span
                                    class="text-4xl font-extrabold text-[#0F5132]">/{{ $totalQuestions }}</span>
                            </div>
                        </div>

                        <!-- Thrived In Block -->
                        <div class="bg-[#EEF2FF] border-2 border-[#E0E7FF] rounded-2xl p-6">
                            <p class="text-[11px] font-bold uppercase tracking-widest text-indigo-700 mb-1">You Thrived
                                In</p>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $topCategory }} - {{ $topPct }}%</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Your foundations in this domain are exceptionally solid. Strong theoretical knowledge
                                and core execution are the backbone of excellent clinical practice — you are well
                                positioned to lead in the ward.
                            </p>
                        </div>

                        <!-- Llama Prediction Block -->
                        <div class="bg-gray-50 border-2 border-gray-200 rounded-2xl p-6 flex-grow">
                            <p class="text-gray-500 text-[11px] font-bold uppercase tracking-widest mb-3">Machine
                                Learning Prediction</p>
                            <div id="ml-prediction-container">
                                @if(!isset($personalizedNote) || $personalizedNote === 'GENERATING' || empty($personalizedNote))
                                    <div class="flex items-center gap-3 text-gray-500 py-1">
                                        <svg class="animate-spin h-5 w-5 text-[#B91C1C]" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        <span class="text-sm font-medium italic text-gray-600">Generating AI Clinical
                                            Insights...</span>
                                    </div>
                                @else
                                    <p class="text-gray-600 leading-relaxed italic text-sm">
                                        "{!! $personalizedNote !!}"
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN -->
                    <div class="flex flex-col gap-6">

                        <!-- 4 Category Mini-Cards (Clean Blade Syntax) -->
                        <div class="grid grid-cols-4 gap-3 h-36">
                            @foreach (['Academic Performance', 'Self-Efficacy', 'Initiative', 'Motivation'] as $cat)
                                @php
                                    $pct = $categoryPercentages[$cat] ?? 0;
                                    $isTop = ($topCategory === $cat);
                                @endphp
                                <div
                                    class="bg-white border-2 {{ $isTop ? 'border-[#FCD34D]' : 'border-gray-200' }} rounded-2xl p-3 text-center relative flex flex-col justify-center">
                                    @if ($isTop)
                                        <span
                                            class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-white border-2 border-[#FCD34D] text-[#D97706] text-[10px] font-extrabold px-3 py-0.5 rounded-full whitespace-nowrap shadow-sm">
                                            ⭐ TOP
                                        </span>
                                    @endif

                                    <div class="text-2xl font-black text-gray-900 mb-2">{{ $pct }}%</div>
                                    <div class="text-[9px] font-bold text-[#B91C1C] uppercase leading-tight tracking-wider">
                                        {!! str_replace(' ', '<br>', $cat) !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Second Best / Growth Block -->
                        <div class="bg-white border-2 border-gray-200 rounded-2xl p-6">
                            <p class="text-[11px] font-bold uppercase tracking-widest text-gray-500 mb-1">Second Best ·
                                Growth Opportunities</p>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">{{ $secondCategory }} - {{ $secondPct }}%
                            </h3>

                            <ul class="space-y-2 mt-3 text-sm text-gray-600">
                                <li class="flex items-start gap-2">
                                    <span class="text-gray-400 font-bold">•</span>
                                    <span>Build clinical confidence through deliberate, repeated practice in simulation
                                        laboratories.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-gray-400 font-bold">•</span>
                                    <span>Actively seek constructive feedback from clinical instructors after every
                                        session.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-gray-400 font-bold">•</span>
                                    <span>Reflect on clinical experiences to identify your specific areas of personal
                                        growth.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-gray-400 font-bold">•</span>
                                    <span>Set small, achievable skill goals during each clinical rotation to build
                                        momentum.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Interpretation Block -->
                        <div class="bg-[#0B1120] text-white rounded-2xl p-6 flex-grow">
                            <h3 class="text-sm font-bold mb-3 tracking-wide">Your Assessment Interpretation</h3>
                            <p class="text-[13px] text-gray-300 leading-relaxed mb-3">
                                Based on your responses, your strongest area is <span
                                    class="text-white font-bold">{{ $topCategory }} {{ $topPct }}%</span>, indicating
                                solid alignment with core clinical competencies. Your second strength lies in <span
                                    class="text-white font-bold">{{ $secondCategory }} ({{ $secondPct }}%)</span>.
                            </p>
                            <p class="text-[13px] text-gray-300 leading-relaxed">
                                Your area with the most room for targeted development is <span
                                    class="text-[#FCD34D] font-bold">{{ $lowestCategory }} ({{ $lowestPct }}%)</span>.
                                Focusing on the key action points above for your second-best area can help you build
                                momentum toward a well-rounded clinical readiness profile. Remember — each assessment is
                                a snapshot in time, not a ceiling.
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Dashboard Button -->
                <div class="mt-10 text-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-block bg-[#0B1120] hover:bg-black text-white font-bold py-3.5 px-12 rounded-full transition shadow-md hover:shadow-lg text-lg">
                        Return to Dashboard
                    </a>
                </div>

            </div>
        </div>
    </div>

    @if(!isset($personalizedNote) || $personalizedNote === 'GENERATING' || empty($personalizedNote))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const resultId = "{{ $result->id ?? $id ?? '' }}";
                if (!resultId) return;

                fetch(`/quiz/${resultId}/get-prediction`)
                    .then(response => response.json())
                    .then(data => {
                        const container = document.getElementById('ml-prediction-container');
                        if (data.personalized_note && container) {
                            container.innerHTML = `<p class="text-gray-600 leading-relaxed italic text-sm">"${data.personalized_note}"</p>`;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching ML prediction:', error);
                    });
            });
        </script>
    @endif
</x-app-layout>