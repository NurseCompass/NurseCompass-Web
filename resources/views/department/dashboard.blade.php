<x-app-layout>
    <!-- 1. The Header Banner (Full-width styling) -->
    <div class="bg-[#FCD34D] w-full py-4 border-b border-[#F59E0B]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-extrabold text-2xl md:text-3xl text-[#B91C1C] leading-tight tracking-wide">
                Dean's Analytics Dashboard
            </h1>
        </div>
    </div>

    <!-- 2. Main Content Area -->
    <div class="py-10 bg-white min-h-screen font-sans pb-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Metrics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white border-2 border-gray-200 rounded-3xl p-6 shadow-sm">
                    <h3 class="text-gray-500 text-xs font-extrabold uppercase tracking-wider">Total Registered Students</h3>
                    <p class="text-3xl font-bold text-[#B91C1C] mt-2">{{ $totalStudents }}</p>
                </div>
                <div class="bg-white border-2 border-gray-200 rounded-3xl p-6 shadow-sm">
                    <h3 class="text-gray-500 text-xs font-extrabold uppercase tracking-wider">Total Assessments Completed</h3>
                    <p class="text-3xl font-bold text-[#B91C1C] mt-2">{{ $totalQuizzesTaken }}</p>
                </div>
                <div class="bg-white border-2 border-gray-200 rounded-3xl p-6 shadow-sm">
                    <h3 class="text-gray-500 text-xs font-extrabold uppercase tracking-wider">Average Score Performance</h3>
                    <p class="text-3xl font-bold text-[#B91C1C] mt-2">{{ number_format($averageScore, 2) }}</p>
                </div>
            </div>

            <!-- Section Overview Table -->
            <div class="bg-white border-2 border-gray-200 rounded-3xl p-6 md:p-8 shadow-sm">
                <h3 class="text-xl font-bold text-[#B91C1C] mb-6 tracking-tight">Section Performance Overview</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y-2 divide-gray-100">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-extrabold text-gray-400 uppercase tracking-wider">Section Name</th>
                                <th class="px-6 py-3 text-left text-xs font-extrabold text-gray-400 uppercase tracking-wider">Year Level</th>
                                <th class="px-6 py-3 text-left text-xs font-extrabold text-gray-400 uppercase tracking-wider">Enrolled Students</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($sections as $section)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#B91C1C]">{{ $section->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-600">{{ $section->year_level }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-600">{{ $section->students_count }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>