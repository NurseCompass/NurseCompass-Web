<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('System Administrator Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-2xl font-bold mb-4">Welcome, Administrator</h3>
                <p class="text-gray-600 dark:text-gray-400">Use the navigation menu above to manage students, sections, faculty assignments, and deans.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                        <h4 class="font-bold text-lg text-blue-800 dark:text-blue-300">Total Students</h4>
                        <p class="text-3xl font-bold mt-2">{{ $totalStudents ?? 0 }}</p>
                    </div>
                    <div class="p-4 bg-teal-50 dark:bg-teal-900/20 rounded-lg border border-teal-200 dark:border-teal-800">
                        <h4 class="font-bold text-lg text-teal-800 dark:text-teal-300">Total Faculty</h4>
                        <p class="text-3xl font-bold mt-2">{{ $totalFaculty ?? 0 }}</p>
                    </div>
                    <div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg border border-purple-200 dark:border-purple-800">
                        <h4 class="font-bold text-lg text-purple-800 dark:text-purple-300">Total Sections</h4>
                        <p class="text-3xl font-bold mt-2">{{ $totalSections ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>