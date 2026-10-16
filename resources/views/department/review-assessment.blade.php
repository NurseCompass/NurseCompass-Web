<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200">
                <div class="p-8 bg-white border-b border-gray-200">

                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-black text-red-800">Review Extracted Questions</h2>
                        <span class="px-4 py-1.5 bg-red-100 text-red-800 font-bold rounded-full text-sm">
                            {{ $yearLevel }}
                        </span>
                    </div>

                    <p class="text-gray-600 mb-8">Please review the questions extracted by the AI below. If everything looks correct, click "Confirm & Activate" at the bottom to make these live for the students. The old questions will be safely archived.</p>

                    <!-- Questions Loop -->
                    <div class="space-y-8">
                        @foreach ($questions as $index => $q)
                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="bg-gray-800 text-white text-xs font-bold px-2 py-1 rounded">Q{{ $index + 1 }}</span>
                                <span class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ $q['section'] }}</span>
                            </div>
                            <p class="text-lg font-bold text-gray-900 mb-4">{{ $q['question_text'] }}</p>

                            <div class="space-y-2 pl-4">
                                @foreach ($q['options'] as $opt)
                                <div class="flex items-center gap-3 p-2 rounded-lg {{ $opt['is_correct'] ? 'bg-green-100 border border-green-300' : 'bg-white border border-gray-200' }}">
                                    @if($opt['is_correct'])
                                    <!-- Green Checkmark for correct answer -->
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    @else
                                    <!-- Empty circle for incorrect options -->
                                    <div class="w-5 h-5 rounded-full border-2 border-gray-300"></div>
                                    @endif

                                    <span class="{{ $opt['is_correct'] ? 'text-green-800 font-bold' : 'text-gray-700' }}">
                                        {{ $opt['option_text'] }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-10 flex justify-between items-center pt-6 border-t border-gray-200">
                        <a href="{{ route('department.assessment.upload') }}" class="text-gray-500 hover:text-red-600 font-bold transition">
                            ← Cancel & Upload Different PDF
                        </a>

                        <form action="{{ route('department.assessment.confirm') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-800 hover:bg-red-900 text-white px-8 py-3 rounded-xl font-bold transition shadow-md">
                                Confirm & Activate Questions
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>