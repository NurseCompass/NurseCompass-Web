<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('department.assessment.confirm') }}" method="POST" class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200">
                @csrf
                <div class="p-8 bg-white border-b border-gray-200">

                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-black text-red-800">Review & Edit Questions</h2>
                        <span class="px-4 py-1.5 bg-red-100 text-red-800 font-bold rounded-full text-sm">
                            {{ $yearLevel }}
                        </span>
                    </div>

                    <p class="text-gray-600 mb-8">Review the AI's extraction below. <strong>You can click on any question or option to edit it manually.</strong> Select the radio button next to the correct answer. When finished, click Confirm.</p>

                    <!-- Questions Loop -->
                    <div class="space-y-8">
                        @foreach ($questions as $index => $q)
                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="bg-gray-800 text-white text-xs font-bold px-2 py-1 rounded">Q{{ $index + 1 }}</span>

                                <!-- Editable Section -->
                                <select name="questions[{{ $index }}][section]" class="text-sm font-bold text-gray-700 uppercase tracking-wider border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 h-8 py-0">
                                    <option value="Academic Performance" {{ $q['section'] == 'Academic Performance' ? 'selected' : '' }}>Academic Performance</option>
                                    <option value="Self-Efficacy" {{ $q['section'] == 'Self-Efficacy' ? 'selected' : '' }}>Self-Efficacy</option>
                                    <option value="Initiative" {{ $q['section'] == 'Initiative' ? 'selected' : '' }}>Initiative</option>
                                    <option value="Motivation" {{ $q['section'] == 'Motivation' ? 'selected' : '' }}>Motivation</option>
                                </select>
                            </div>

                            <!-- Editable Question Text -->
                            <textarea name="questions[{{ $index }}][question_text]" rows="2" class="w-full text-lg font-bold text-gray-900 mb-4 border-gray-300 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500" required>{{ $q['question_text'] }}</textarea>

                            <!-- Editable Options -->
                            <div class="space-y-2 pl-4">
                                @foreach ($q['options'] as $optIndex => $opt)
                                <div class="flex items-center gap-3">
                                    <!-- Radio Button for Correct Answer -->
                                    <input type="radio" name="questions[{{ $index }}][correct_option]" value="{{ $optIndex }}" {{ $opt['is_correct'] ? 'checked' : '' }} class="w-5 h-5 text-green-600 focus:ring-green-500 border-gray-300 cursor-pointer" required>

                                    <!-- Option Text Input -->
                                    <input type="text" name="questions[{{ $index }}][options][{{ $optIndex }}]" value="{{ $opt['option_text'] }}" class="flex-1 border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 {{ $opt['is_correct'] ? 'bg-green-50 font-bold' : '' }}" required>
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

                        <button type="submit" class="bg-red-800 hover:bg-red-900 text-white px-8 py-3 rounded-xl font-bold transition shadow-md">
                            Confirm & Activate Questions
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-app-layout>