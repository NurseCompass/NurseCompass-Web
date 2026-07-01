<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ auth()->user()->year_level }} - {{ $dbSection }} Assessment
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <form action="/quiz/submit" method="POST">
                @csrf
                
                <input type="hidden" name="section" value="{{ $dbSection }}">

                @foreach($questions as $index => $question)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700 mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                                {{ $index + 1 }}. {{ $question->question_text }}
                            </h3>

                            <div class="space-y-3">
                                @foreach($question->options as $option)
                                    <label class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <input type="radio" name="question_{{ $question->id }}" value="{{ $option->id }}" required class="w-4 h-4 text-teal-600 border-gray-300 focus:ring-teal-500">
                                        <span class="ml-3 text-gray-700 dark:text-gray-300">{{ $option->option_text }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="flex justify-end mt-6 mb-12">
                    <button type="submit" class="bg-gray-900 hover:bg-black dark:bg-gray-100 dark:hover:bg-white dark:text-gray-900 text-white font-semibold py-3 px-8 rounded-lg shadow-md transition duration-150">
                        Submit Assessment
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>