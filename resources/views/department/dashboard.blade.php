<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dean's Analytics Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Metrics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-gray-500 text-sm font-medium">Total Registered Students</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalStudents }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-gray-500 text-sm font-medium">Total Assessments Completed</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalQuizzesTaken }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-gray-500 text-sm font-medium">Average Score Performance</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($averageScore, 2) }}</p>
                </div>
            </div>

            <!-- Section Overview Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Section Performance Overview</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Section Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year Level</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enrolled Students</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($sections as $section)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $section->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $section->year_level }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $section->students_count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>