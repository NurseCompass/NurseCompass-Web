<x-app-layout>
    <div class="min-h-screen bg-gray-50 pb-12">

        <!-- Assessment History Banner -->
        <div class="bg-[#FDE082] py-4 px-8 mb-8 border-b border-amber-300">
            <h1 class="text-3xl font-extrabold text-[#981B1E] max-w-7xl mx-auto">
                Assessment History
            </h1>
        </div>

        <!-- Main Content Area -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($assessments as $item)
                @php
                $id = is_array($item) ? ($item['id'] ?? 1) : $item->id;
                $title = is_array($item) ? ($item['title'] ?? 'Assessment') : ($item->title ?? 'Assessment');
                $completedAt = is_array($item) ? ($item['completed_at'] ?? 'Recently') : ($item->created_at ? $item->created_at->format('F d, Y') : 'Recently');
                $score = is_array($item) ? ($item['score'] ?? 0) : ($item->score ?? 0);
                $total = is_array($item) ? ($item['total'] ?? 32) : ($item->total ?? 32);
                $topTrait = is_array($item) ? ($item['top_trait'] ?? 'Motivation') : ($item->top_trait ?? 'Motivation');
                $academic = is_array($item) ? ($item['academic_performance'] ?? 0) : ($item->academic_performance ?? 0);
                $efficacy = is_array($item) ? ($item['self_efficacy'] ?? 0) : ($item->self_efficacy ?? 0);
                $initiative = is_array($item) ? ($item['initiative'] ?? 0) : ($item->initiative ?? 0);
                $motivation = is_array($item) ? ($item['motivation'] ?? 0) : ($item->motivation ?? 0);
                @endphp

                <!-- Clickable Assessment Card -->
                <a href="{{ route('quiz.result', $id) }}" class="block bg-white rounded-2xl p-6 border border-gray-200 shadow-md hover:shadow-xl hover:border-red-300 transition-all duration-200 cursor-pointer relative group">

                    <!-- Header & Score Circle Badge -->
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-2xl font-black text-[#B01B1E] group-hover:text-red-700 transition-colors">
                                {{ $title }}
                            </h2>
                            <p class="text-sm font-semibold text-gray-500 flex items-center mt-1">
                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Completed {{ $completedAt }}
                            </p>
                        </div>

                        <!-- Circle Score Badge -->
                        <div class="flex flex-col items-center shrink-0 ml-4">
                            <div class="w-16 h-16 rounded-full border-2 border-[#15803D] flex items-center justify-center text-lg font-black text-[#15803D]">
                                {{ $score }}/{{ $total }}
                            </div>
                            <span class="mt-2 bg-[#1B6B40] text-white text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap">
                                Top: {{ $topTrait }}
                            </span>
                        </div>
                    </div>

                    <!-- Progress Bars Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 mt-4">

                        <!-- Academic Performance -->
                        <div>
                            <div class="flex justify-between text-xs font-bold text-[#800000] mb-1">
                                <span>ACADEMIC PERFORMANCE</span>
                                <span>{{ $academic }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                <div class="bg-[#F59E0B] h-2 rounded-full transition-all duration-500" @style(['width: ' . $academic . ' %'])></div>
                            </div>
                        </div>

                        <!-- Self-Efficacy -->
                        <div>
                            <div class="flex justify-between text-xs font-bold text-[#800000] mb-1">
                                <span>SELF-EFFICACY</span>
                                <span>{{ $efficacy }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                <div class="bg-[#F59E0B] h-2 rounded-full transition-all duration-500" @style(['width: ' . $efficacy . ' %'])></div>
                            </div>
                        </div>

                        <!-- Initiative -->
                        <div>
                            <div class="flex justify-between text-xs font-bold text-[#800000] mb-1">
                                <span>INITIATIVE</span>
                                <span>{{ $initiative }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                <div class="bg-[#F59E0B] h-2 rounded-full transition-all duration-500" @style(['width: ' . $initiative . ' %'])></div>
                            </div>
                        </div>

                        <!-- Motivation -->
                        <div>
                            <div class="flex justify-between text-xs font-bold text-[#800000] mb-1">
                                <span>MOTIVATION</span>
                                <span>{{ $motivation }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                <div class="bg-[#F59E0B] h-2 rounded-full transition-all duration-500" @style(['width: ' . $motivation . ' %'])></div>
                            </div>
                        </div>

                    </div>
                </a>
                @empty
                <div class="col-span-2 bg-white rounded-2xl p-8 border border-gray-200 shadow-sm text-center">
                    <p class="text-gray-500 font-semibold">No assessment history found yet.</p>
                </div>
                @endforelse
            </div>
        </main>
    </div>
</x-app-layout>