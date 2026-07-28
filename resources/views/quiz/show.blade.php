<x-app-layout>
    <!-- 1. The Header Slot (Keeps the navigation bar from exploding) -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comprehensive Assessment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- 2. The Form Wrapper -->
            <form action="/submit-quiz" method="POST" id="assessmentForm">
                @csrf
                <input type="hidden" name="section" value="Comprehensive">

                <!-- ========================================== -->
                <!-- SECTION 1: ACADEMIC PERFORMANCE (Visible)  -->
                <!-- ========================================== -->
                <div id="section-1" class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 block">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Part 1: Academic Performance</h2>
                    
                    @foreach($groupedQuestions['Academic Performance'] ?? [] as $question)
                        <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-5 rounded-lg border border-gray-100 dark:border-gray-600">
                            <p class="font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ $loop->iteration }}. {{ $question->question_text }}</p>
                            
                            <div class="space-y-2">
                                @foreach($question->options as $option)
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="question_{{ $question->id }}" value="{{ $option->id }}" class="mr-3 text-teal-600 focus:ring-teal-500" required>
                                        <span class="text-gray-700 dark:text-gray-300">{{ $option->option_text }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-8 flex justify-end">
                        <button type="button" onclick="goToSection(1, 2)" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2.5 rounded-lg font-bold transition">
                            Next: Self-Efficacy
                        </button>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- SECTION 2: SELF-EFFICACY (Hidden)          -->
                <!-- ========================================== -->
                <div id="section-2" class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hidden">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Part 2: Self-Efficacy</h2>
                    
                    @foreach($groupedQuestions['Self-Efficacy'] ?? [] as $question)
                        <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-5 rounded-lg border border-gray-100 dark:border-gray-600">
                            <p class="font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ $loop->iteration }}. {{ $question->question_text }}</p>
                            
                            <div class="space-y-2">
                                @foreach($question->options as $option)
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="question_{{ $question->id }}" value="{{ $option->id }}" class="mr-3 text-teal-600 focus:ring-teal-500" required>
                                        <span class="text-gray-700 dark:text-gray-300">{{ $option->option_text }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-8 flex justify-between">
                        <button type="button" onclick="goToSection(2, 1)" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2.5 rounded-lg font-bold transition">Back</button>
                        <button type="button" onclick="goToSection(2, 3)" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2.5 rounded-lg font-bold transition">Next: Initiative</button>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- SECTION 3: INITIATIVE (Hidden)             -->
                <!-- ========================================== -->
                <div id="section-3" class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hidden">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Part 3: Initiative</h2>
                    
                    @foreach($groupedQuestions['Initiative'] ?? [] as $question)
                        <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-5 rounded-lg border border-gray-100 dark:border-gray-600">
                            <p class="font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ $loop->iteration }}. {{ $question->question_text }}</p>
                            
                            <div class="space-y-2">
                                @foreach($question->options as $option)
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="question_{{ $question->id }}" value="{{ $option->id }}" class="mr-3 text-teal-600 focus:ring-teal-500" required>
                                        <span class="text-gray-700 dark:text-gray-300">{{ $option->option_text }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-8 flex justify-between">
                        <button type="button" onclick="goToSection(3, 2)" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2.5 rounded-lg font-bold transition">Back</button>
                        <button type="button" onclick="goToSection(3, 4)" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2.5 rounded-lg font-bold transition">Next: Motivation</button>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- SECTION 4: MOTIVATION (Hidden & Final)     -->
                <!-- ========================================== -->
                <div id="section-4" class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hidden">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Part 4: Motivation</h2>
                    
                    @foreach($groupedQuestions['Motivation'] ?? [] as $question)
                        <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-5 rounded-lg border border-gray-100 dark:border-gray-600">
                            <p class="font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ $loop->iteration }}. {{ $question->question_text }}</p>
                            
                            <div class="space-y-2">
                                @foreach($question->options as $option)
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="question_{{ $question->id }}" value="{{ $option->id }}" class="mr-3 text-teal-600 focus:ring-teal-500" required>
                                        <span class="text-gray-700 dark:text-gray-300">{{ $option->option_text }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-8 flex justify-between">
                        <button type="button" onclick="goToSection(4, 3)" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2.5 rounded-lg font-bold transition">Back</button>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-bold text-lg transition shadow-lg">
                            Submit Final Assessment
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!-- The JavaScript to handle the Next/Back button animations -->
    <!-- The JavaScript to handle the Next/Back button animations and validation -->
    <script>
        function goToSection(currentId, nextId) {
            
            // ONLY VALIDATE IF MOVING FORWARD
            if (nextId > currentId) {
                let currentSection = document.getElementById('section-' + currentId);
                let isMissingAnswer = false;
                
                // 1. Gather the names of every question in this specific section
                let questionNames = new Set();
                currentSection.querySelectorAll('input[type="radio"]').forEach(radio => {
                    questionNames.add(radio.name);
                });

                // 2. Check if every single question has a checked bubble
                questionNames.forEach(name => {
                    if (!currentSection.querySelector(`input[name="${name}"]:checked`)) {
                        isMissingAnswer = true;
                    }
                });

                // 3. If an answer is missing, stop them from moving forward
                if (isMissingAnswer) {
                    alert("Please answer all questions in this section before proceeding.");
                    return; // This completely stops the function
                }
            }

            // If everything is answered (or if they are just clicking "Back"):
            // Hide current section
            document.getElementById('section-' + currentId).classList.add('hidden');
            document.getElementById('section-' + currentId).classList.remove('block');
            
            // Show next section
            document.getElementById('section-' + nextId).classList.remove('hidden');
            document.getElementById('section-' + nextId).classList.add('block');
            
            // Scroll smoothly to the top of the page
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
</x-app-layout>