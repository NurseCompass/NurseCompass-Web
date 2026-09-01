<!DOCTYPE html>
<html>

<head>
    <title>Assessment Results | NurseCompass</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 h-screen w-full flex items-center justify-center p-4 lg:p-6 overflow-hidden">

    @php
    $topCategory = $topCategory ?? 'Academic Performance';
    $topPct = $topPct ?? 0;
    $secondCategory = $secondCategory ?? 'Self-Efficacy';
    $secondPct = $secondPct ?? 0;
    $lowestCategory = $lowestCategory ?? 'Motivation';
    $lowestPct = $lowestPct ?? 0;
    $categoryPercentages = $categoryPercentages ?? [];
    @endphp

    <div class="w-full max-w-7xl max-h-full bg-white rounded-2xl shadow-2xl p-6 lg:p-8 flex flex-col">

        <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-900 text-center mb-5 tracking-tight shrink-0">Assessment Complete!!</h1>

        <!-- 2-Column Layout Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 flex-grow min-h-0">

            <!-- LEFT COLUMN -->
            <div class="flex flex-col gap-4">

                <!-- 1. Score Block -->
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 text-center shadow-sm shrink-0">
                    <p class="text-slate-500 font-bold uppercase tracking-wider text-xs mb-1">Your Score</p>
                    <div class="text-5xl font-black text-teal-600">{{ $score }} <span class="text-3xl text-slate-400 font-bold">/ {{ $totalQuestions }}</span></div>
                </div>

                <!-- 2. Thrived In Block -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 shadow-sm shrink-0">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-blue-600">You Thrived In</span>
                    <h3 class="text-lg font-bold text-slate-900 mt-1">{{ $topCategory }} — {{ $topPct }}%</h3>
                    <p class="text-slate-600 text-sm mt-2 leading-relaxed">
                        Your foundations in this domain are exceptionally solid. Strong theoretical knowledge and core execution are the backbone of excellent clinical practice — you are well positioned to lead in the ward.
                    </p>
                </div>

                <!-- 3. Llama Prediction Block -->
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 shadow-sm flex-grow">
                    <p class="text-slate-500 text-[11px] font-bold uppercase tracking-wider mb-2">Machine Learning Prediction</p>
                    <p class="text-slate-700 leading-relaxed italic text-sm">
                        "{!! $personalizedNote !!}"
                    </p>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="flex flex-col gap-4">

                <!-- 1. 4 Category Mini-Cards -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 shrink-0">
                    @foreach(['Academic Performance', 'Self-Efficacy', 'Initiative', 'Motivation'] as $cat)
                    @php
                    $pct = $categoryPercentages[$cat] ?? 0;
                    $isTop = ($topCategory === $cat);
                    @endphp
                    <div class="bg-white border {{ $isTop ? 'border-amber-300 ring-2 ring-amber-100' : 'border-slate-200' }} rounded-xl p-3 shadow-sm text-center relative flex flex-col justify-center h-24">
                        @if($isTop)
                        <span class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-amber-100 text-amber-800 text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm whitespace-nowrap">
                            ⭐ TOP
                        </span>
                        @endif
                        <div class="text-2xl font-extrabold text-blue-600 mb-1">{{ $pct }}%</div>
                        <div class="text-[10px] font-bold text-slate-500 uppercase leading-tight">{{ $cat }}</div>
                    </div>
                    @endforeach
                </div>

                <!-- 2. Second Best / Growth Block -->
                <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm shrink-0">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Second Best · Growth Opportunities</span>
                    <h3 class="text-lg font-bold text-slate-900 mt-1">{{ $secondCategory }} — {{ $secondPct }}%</h3>

                    <ul class="space-y-1.5 mt-3 text-sm text-slate-600">
                        <li class="flex items-start gap-2">
                            <span class="text-blue-500 font-bold">•</span>
                            <span>Build clinical confidence through deliberate, repeated practice in simulation laboratories.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-blue-500 font-bold">•</span>
                            <span>Actively seek constructive feedback from clinical instructors after every session.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-blue-500 font-bold">•</span>
                            <span>Reflect on clinical experiences to identify your specific areas of personal growth.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-blue-500 font-bold">•</span>
                            <span>Set small, achievable skill goals during each clinical rotation to build momentum.</span>
                        </li>
                    </ul>
                </div>

                <!-- 3. Interpretation Block -->
                <div class="bg-slate-900 text-slate-100 rounded-xl p-5 shadow-md flex-grow">
                    <h3 class="text-lg font-bold mb-2 text-white tracking-wide">Your Assessment Interpretation</h3>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        Based on your responses, your strongest area is <span class="text-white font-semibold">{{ $topCategory }} ({{ $topPct }}%)</span>, indicating solid alignment with core clinical competencies. Your second strength lies in <span class="text-white font-semibold">{{ $secondCategory }} ({{ $secondPct }}%)</span>.
                    </p>
                    <p class="text-sm text-slate-300 leading-relaxed mt-2">
                        Your area with the most room for targeted development is <span class="text-amber-400 font-semibold">{{ $lowestCategory }} ({{ $lowestPct }}%)</span>. Focusing on the key action points above for your second-best area can help you build momentum toward a well-rounded clinical readiness profile. Remember — each assessment is a snapshot in time, not a ceiling.
                    </p>
                </div>
            </div>

        </div>

        <!-- Dashboard Button -->
        <div class="mt-6 text-center shrink-0">
            <a href="/dashboard" class="inline-block bg-slate-900 hover:bg-black text-white font-bold py-3 px-10 rounded-lg transition shadow-md hover:shadow-lg">
                Return to Dashboard
            </a>
        </div>
    </div>

</body>

</html>