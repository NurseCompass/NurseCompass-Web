<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Faculty & Section Assignments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-green-900/20 dark:text-green-400">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-2xl font-bold mb-2">Assign Sections to Faculty</h3>
                <p class="mb-6 text-gray-500 dark:text-gray-400">Select multiple sections that each professor handles.</p>

                <div class="space-y-6">
                    @forelse($facultyMembers as $faculty)
                    <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-900/40">
                        <h4 class="font-bold text-lg text-teal-600 dark:text-teal-400 mb-3">{{ $faculty->name }} <span class="text-xs font-normal text-gray-500">({{ $faculty->email }})</span></h4>

                        <form action="{{ route('admin.faculty.sections', $faculty->id) }}" method="POST">
                            @csrf
                            <div class="flex flex-wrap gap-4 mb-4">
                                @foreach($sections as $section)
                                <label class="inline-flex items-center bg-white dark:bg-gray-800 px-3 py-1.5 rounded border border-gray-200 dark:border-gray-700">
                                    <input type="checkbox" name="sections[]" value="{{ $section->id }}"
                                        {{ $faculty->handledSections->contains($section->id) ? 'checked' : '' }}
                                        class="text-teal-600 rounded border-gray-300 focus:ring-teal-500">
                                    <span class="ml-2 text-sm font-medium">{{ $section->name }} (Year {{ $section->year_level }})</span>
                                </label>
                                @endforeach
                            </div>
                            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold py-2 px-5 rounded transition shadow-sm">
                                Save Assignments for {{ $faculty->name }}
                            </button>
                        </form>
                    </div>
                    @empty
                    <p class="text-gray-500">No faculty members found in the system.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>