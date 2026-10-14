<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- 1. The Header Banner (Bypassing the default slot for full-width styling) -->
    <div class="bg-[#FCD34D] w-full py-4 border-b border-[#F59E0B]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-extrabold text-2xl md:text-3xl text-[#B91C1C] leading-tight tracking-wide">
                Comprehensive Assessment
            </h1>
        </div>
    </div>

    <div class="py-10 bg-white">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <form action="/submit-quiz" method="POST" id="assessmentForm">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="section" value="Comprehensive">

                <!-- ========================================== -->
                <!-- SECTION 1: ACADEMIC PERFORMANCE            -->
                <!-- ========================================== -->
                <div id="section-1" class="bg-white p-8 md:p-10 rounded-3xl border-2 border-gray-200 block">
                    <h2 class="text-2xl font-bold mb-6 text-[#B91C1C]">Part 1: Academic Performance</h2>

                    <?php $q1 = 1;
                    foreach ($groupedQuestions['Academic Performance'] ?? [] as $question): ?>
                        <div class="mb-6 bg-[#E5E5E5] p-6 rounded-2xl">
                            <p class="font-bold text-[#B91C1C] mb-4 text-lg leading-relaxed"><?php echo e($q1++); ?>. <?php echo e($question->question_text); ?></p>

                            <div class="space-y-3 pl-4">
                                <?php foreach ($question->options as $option): ?>
                                    <label class="flex items-center cursor-pointer group">
                                        <input type="radio" name="question_<?php echo e($question->id); ?>" value="<?php echo e($option->id); ?>" class="mr-4 w-5 h-5 text-[#0F5132] focus:ring-[#0F5132] bg-white border-gray-400" required>
                                        <span class="text-gray-900 font-medium group-hover:text-black transition-colors text-[15px]"><?php echo e($option->option_text); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="mt-8 flex justify-end">
                        <button type="button" onclick="goToSection(1, 2)" class="bg-[#0F5132] hover:bg-green-900 text-white px-8 py-3 rounded-full font-bold text-lg transition shadow-md">
                            Next: Self-Efficacy
                        </button>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- SECTION 2: SELF-EFFICACY                   -->
                <!-- ========================================== -->
                <div id="section-2" class="bg-white p-8 md:p-10 rounded-3xl border-2 border-gray-200 hidden">
                    <h2 class="text-2xl font-bold mb-6 text-[#B91C1C]">Part 2: Self-Efficacy</h2>

                    <?php $q2 = 1;
                    foreach ($groupedQuestions['Self-Efficacy'] ?? [] as $question): ?>
                        <div class="mb-6 bg-[#E5E5E5] p-6 rounded-2xl">
                            <p class="font-bold text-[#B91C1C] mb-4 text-lg leading-relaxed"><?php echo e($q2++); ?>. <?php echo e($question->question_text); ?></p>

                            <div class="space-y-3 pl-4">
                                <?php foreach ($question->options as $option): ?>
                                    <label class="flex items-center cursor-pointer group">
                                        <input type="radio" name="question_<?php echo e($question->id); ?>" value="<?php echo e($option->id); ?>" class="mr-4 w-5 h-5 text-[#0F5132] focus:ring-[#0F5132] bg-white border-gray-400" required>
                                        <span class="text-gray-900 font-medium group-hover:text-black transition-colors text-[15px]"><?php echo e($option->option_text); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="mt-8 flex justify-between">
                        <button type="button" onclick="goToSection(2, 1)" class="bg-[#C0C0C0] hover:bg-gray-400 text-white px-10 py-3 rounded-full font-bold text-lg transition shadow-md">
                            Back
                        </button>
                        <button type="button" onclick="goToSection(2, 3)" class="bg-[#0F5132] hover:bg-green-900 text-white px-8 py-3 rounded-full font-bold text-lg transition shadow-md">
                            Next: Initiative
                        </button>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- SECTION 3: INITIATIVE                      -->
                <!-- ========================================== -->
                <div id="section-3" class="bg-white p-8 md:p-10 rounded-3xl border-2 border-gray-200 hidden">
                    <h2 class="text-2xl font-bold mb-6 text-[#B91C1C]">Part 3: Initiative</h2>

                    <?php $q3 = 1;
                    foreach ($groupedQuestions['Initiative'] ?? [] as $question): ?>
                        <div class="mb-6 bg-[#E5E5E5] p-6 rounded-2xl">
                            <p class="font-bold text-[#B91C1C] mb-4 text-lg leading-relaxed"><?php echo e($q3++); ?>. <?php echo e($question->question_text); ?></p>

                            <div class="space-y-3 pl-4">
                                <?php foreach ($question->options as $option): ?>
                                    <label class="flex items-center cursor-pointer group">
                                        <input type="radio" name="question_<?php echo e($question->id); ?>" value="<?php echo e($option->id); ?>" class="mr-4 w-5 h-5 text-[#0F5132] focus:ring-[#0F5132] bg-white border-gray-400" required>
                                        <span class="text-gray-900 font-medium group-hover:text-black transition-colors text-[15px]"><?php echo e($option->option_text); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="mt-8 flex justify-between">
                        <button type="button" onclick="goToSection(3, 2)" class="bg-[#C0C0C0] hover:bg-gray-400 text-white px-10 py-3 rounded-full font-bold text-lg transition shadow-md">
                            Back
                        </button>
                        <button type="button" onclick="goToSection(3, 4)" class="bg-[#0F5132] hover:bg-green-900 text-white px-8 py-3 rounded-full font-bold text-lg transition shadow-md">
                            Next: Motivation
                        </button>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- SECTION 4: MOTIVATION                      -->
                <!-- ========================================== -->
                <div id="section-4" class="bg-white p-8 md:p-10 rounded-3xl border-2 border-gray-200 hidden">
                    <h2 class="text-2xl font-bold mb-6 text-[#B91C1C]">Part 4: Motivation</h2>

                    <?php $q4 = 1;
                    foreach ($groupedQuestions['Motivation'] ?? [] as $question): ?>
                        <div class="mb-6 bg-[#E5E5E5] p-6 rounded-2xl">
                            <p class="font-bold text-[#B91C1C] mb-4 text-lg leading-relaxed"><?php echo e($q4++); ?>. <?php echo e($question->question_text); ?></p>

                            <div class="space-y-3 pl-4">
                                <?php foreach ($question->options as $option): ?>
                                    <label class="flex items-center cursor-pointer group">
                                        <input type="radio" name="question_<?php echo e($question->id); ?>" value="<?php echo e($option->id); ?>" class="mr-4 w-5 h-5 text-[#0F5132] focus:ring-[#0F5132] bg-white border-gray-400" required>
                                        <span class="text-gray-900 font-medium group-hover:text-black transition-colors text-[15px]"><?php echo e($option->option_text); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="mt-8 flex justify-between">
                        <button type="button" onclick="goToSection(4, 3)" class="bg-[#C0C0C0] hover:bg-gray-400 text-white px-10 py-3 rounded-full font-bold text-lg transition shadow-md">
                            Back
                        </button>
                        <button type="submit" class="bg-[#0F5132] hover:bg-green-900 text-white px-8 py-3 rounded-full font-bold text-lg transition shadow-md">
                            Submit Final Assessment
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!-- JavaScript Navigation -->
    <script>
        function goToSection(currentId, nextId) {
            if (nextId > currentId) {
                let currentSection = document.getElementById('section-' + currentId);
                let isMissingAnswer = false;

                let questionNames = new Set();
                currentSection.querySelectorAll('input[type="radio"]').forEach(radio => {
                    questionNames.add(radio.name);
                });

                questionNames.forEach(name => {
                    if (!currentSection.querySelector(`input[name="${name}"]:checked`)) {
                        isMissingAnswer = true;
                    }
                });

                if (isMissingAnswer) {
                    alert("Please answer all questions in this section before proceeding.");
                    return;
                }
            }

            document.getElementById('section-' + currentId).classList.add('hidden');
            document.getElementById('section-' + currentId).classList.remove('block');

            document.getElementById('section-' + nextId).classList.remove('hidden');
            document.getElementById('section-' + nextId).classList.add('block');

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\NurseCompass-Web\resources\views/quiz/show.blade.php ENDPATH**/ ?>