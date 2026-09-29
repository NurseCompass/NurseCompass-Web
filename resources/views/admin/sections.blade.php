<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Sections') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-2xl font-bold mb-2">Registered Sections</h3>
                <p class="mb-6 text-gray-500 dark:text-gray-400">Overview of all active block sections in the system.</p>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400">
                                <th class="py-3 px-4">Section Name</th>
                                <th class="py-3 px-4">Year Level</th>
                                <th class="py-3 px-4">Enrolled Students Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sections as $section)
                            <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                <td class="py-3 px-4 font-semibold">{{ $section->name }}</td>
                                <td class="py-3 px-4">{{ $section->year_level }}</td>
                                <td class="py-3 px-4">{{ $section->students()->count() }} students</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-gray-500">No sections found. Import students to automatically populate sections!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>