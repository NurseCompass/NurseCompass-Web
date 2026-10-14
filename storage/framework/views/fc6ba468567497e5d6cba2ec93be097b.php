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
    <?php
    $topCategory = $topCategory ?? 'Academic Performance';
    $topPct = $topPct ?? 0;
    $secondCategory = $secondCategory ?? 'Self-Efficacy';
    $secondPct = $secondPct ?? 0;
    $lowestCategory = $lowestCategory ?? 'Motivation';
    $lowestPct = $lowestPct ?? 0;
    $categoryPercentages = $categoryPercentages ?? [];
    ?>

    <!-- 1. The Header Banner (Full-width styling) -->
    <div class="bg-[#FCD34D] w-full py-4 border-b border-[#F59E0B]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-extrabold text-2xl md:text-3xl text-[#B91C1C] leading-tight tracking-wide">
                Comprehensive Assessment
            </h1>
        </div>
    </div>

    <!-- 2. Main Content Area -->
    <div class="py-10 bg-white min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <!-- Assessment Container -->
            <div class="bg-white rounded-3xl border-2 border-gray-200 p-8 lg:p-10 flex flex-col shadow-sm">

                <!-- Title -->
                <h2 class="text-3xl font-extrabold text-[#B91C1C] text-center mb-8">Assessment Complete!</h2>

                <!-- 2-Column Layout Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 flex-grow">

                    <!-- ========================================== -->
                    <!-- LEFT COLUMN                                -->
                    <!-- ========================================== -->
                    <div class="flex flex-col gap-6">

                        <!-- Score Block -->
                        <div class="bg-white border-2 border-gray-200 rounded-2xl p-6 text-center flex flex-col justify-center items-center h-36">
                            <p class="text-[#B91C1C] font-bold uppercase tracking-widest text-[11px] mb-2">Your Score</p>
                            <div class="text-5xl font-black text-[#0F5132]">
                                <?php echo e($score); ?><span class="text-4xl font-extrabold text-[#0F5132]">/<?php echo e($totalQuestions); ?></span>
                            </div>
                        </div>

                        <!-- Thrived In Block -->
                        <div class="bg-[#EEF2FF] border-2 border-[#E0E7FF] rounded-2xl p-6">
                            <p class="text-[11px] font-bold uppercase tracking-widest text-indigo-700 mb-1">You Thrived In</p>
                            <h3 class="text-xl font-bold text-gray-900 mb-2"><?php echo e($topCategory); ?> - <?php echo e($topPct); ?>%</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Your foundations in this domain are exceptionally solid. Strong theoretical knowledge and core execution are the backbone of excellent clinical practice — you are well positioned to lead in the ward.
                            </p>
                        </div>

                        <!-- Llama Prediction Block -->
                        <div class="bg-gray-50 border-2 border-gray-200 rounded-2xl p-6 flex-grow">
                            <p class="text-gray-500 text-[11px] font-bold uppercase tracking-widest mb-3">Machine Learning Prediction</p>
                            <p class="text-gray-600 leading-relaxed italic text-sm">
                                "<?php echo $personalizedNote; ?>"
                            </p>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- RIGHT COLUMN                               -->
                    <!-- ========================================== -->
                    <div class="flex flex-col gap-6">

                        <!-- 4 Category Mini-Cards -->
                        <div class="grid grid-cols-4 gap-3 h-36">
                            <?php foreach (['Academic Performance', 'Self-Efficacy', 'Initiative', 'Motivation'] as $cat): ?>
                                <?php
                                $pct = $categoryPercentages[$cat] ?? 0;
                                $isTop = ($topCategory === $cat);
                                ?>
                                <div class="bg-white border-2 <?php echo $isTop ? 'border-[#FCD34D]' : 'border-gray-200'; ?> rounded-2xl p-3 text-center relative flex flex-col justify-center">
                                    <?php if ($isTop): ?>
                                        <span class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-white border-2 border-[#FCD34D] text-[#D97706] text-[10px] font-extrabold px-3 py-0.5 rounded-full whitespace-nowrap shadow-sm">
                                            ⭐ TOP
                                        </span>
                                    <?php endif; ?>

                                    <div class="text-2xl font-black text-gray-900 mb-2"><?php echo e($pct); ?>%</div>
                                    <div class="text-[9px] font-bold text-[#B91C1C] uppercase leading-tight tracking-wider">
                                        <?php echo str_replace(' ', '<br>', $cat); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Second Best / Growth Block -->
                        <div class="bg-white border-2 border-gray-200 rounded-2xl p-6">
                            <p class="text-[11px] font-bold uppercase tracking-widest text-gray-500 mb-1">Second Best · Growth Opportunities</p>
                            <h3 class="text-lg font-bold text-gray-900 mb-3"><?php echo e($secondCategory); ?> - <?php echo e($secondPct); ?>%</h3>

                            <ul class="space-y-2 mt-3 text-sm text-gray-600">
                                <li class="flex items-start gap-2">
                                    <span class="text-gray-400 font-bold">•</span>
                                    <span>Build clinical confidence through deliberate, repeated practice in simulation laboratories.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-gray-400 font-bold">•</span>
                                    <span>Actively seek constructive feedback from clinical instructors after every session.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-gray-400 font-bold">•</span>
                                    <span>Reflect on clinical experiences to identify your specific areas of personal growth.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-gray-400 font-bold">•</span>
                                    <span>Set small, achievable skill goals during each clinical rotation to build momentum.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Interpretation Block -->
                        <div class="bg-[#0B1120] text-white rounded-2xl p-6 flex-grow">
                            <h3 class="text-sm font-bold mb-3 tracking-wide">Your Assessment Interpretation</h3>
                            <p class="text-[13px] text-gray-300 leading-relaxed mb-3">
                                Based on your responses, your strongest area is <span class="text-white font-bold"><?php echo e($topCategory); ?> <?php echo e($topPct); ?>%</span>, indicating solid alignment with core clinical competencies. Your second strength lies in <span class="text-white font-bold"><?php echo e($secondCategory); ?> (<?php echo e($secondPct); ?>%)</span>.
                            </p>
                            <p class="text-[13px] text-gray-300 leading-relaxed">
                                Your area with the most room for targeted development is <span class="text-[#FCD34D] font-bold"><?php echo e($lowestCategory); ?> (<?php echo e($lowestPct); ?>%)</span>. Focusing on the key action points above for your second-best area can help you build momentum toward a well-rounded clinical readiness profile. Remember — each assessment is a snapshot in time, not a ceiling.
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Dashboard Button -->
                <div class="mt-10 text-center">
                    <a href="/dashboard" class="inline-block bg-[#0B1120] hover:bg-black text-white font-bold py-3.5 px-12 rounded-full transition shadow-md hover:shadow-lg text-lg">
                        Return to Dashboard
                    </a>
                </div>

            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\NurseCompass-Web\resources\views/quiz/results.blade.php ENDPATH**/ ?>