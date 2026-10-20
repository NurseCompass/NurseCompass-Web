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
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form action="<?php echo e(route('department.assessment.confirm')); ?>" method="POST" class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200">
                <?php echo csrf_field(); ?>
                <div class="p-8 bg-white border-b border-gray-200">

                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-black text-red-800">Review & Edit Questions</h2>
                        <span class="px-4 py-1.5 bg-red-100 text-red-800 font-bold rounded-full text-sm">
                            <?php echo e($yearLevel); ?>

                        </span>
                    </div>

                    <p class="text-gray-600 mb-8">Review the AI's extraction below. <strong>You can click on any question or option to edit it manually.</strong> Select the radio button next to the correct answer. When finished, click Confirm.</p>

                    <!-- Questions Loop -->
                    <div class="space-y-8">
                        <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="bg-gray-800 text-white text-xs font-bold px-2 py-1 rounded">Q<?php echo e($index + 1); ?></span>

                                <!-- Editable Section -->
                                <select name="questions[<?php echo e($index); ?>][section]" class="text-sm font-bold text-gray-700 uppercase tracking-wider border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 h-8 py-0">
                                    <option value="Academic Performance" <?php echo e($q['section'] == 'Academic Performance' ? 'selected' : ''); ?>>Academic Performance</option>
                                    <option value="Self-Efficacy" <?php echo e($q['section'] == 'Self-Efficacy' ? 'selected' : ''); ?>>Self-Efficacy</option>
                                    <option value="Initiative" <?php echo e($q['section'] == 'Initiative' ? 'selected' : ''); ?>>Initiative</option>
                                    <option value="Motivation" <?php echo e($q['section'] == 'Motivation' ? 'selected' : ''); ?>>Motivation</option>
                                </select>
                            </div>

                            <!-- Editable Question Text -->
                            <textarea name="questions[<?php echo e($index); ?>][question_text]" rows="2" class="w-full text-lg font-bold text-gray-900 mb-4 border-gray-300 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500" required><?php echo e($q['question_text']); ?></textarea>

                            <!-- Editable Options -->
                            <div class="space-y-2 pl-4">
                                <?php $__currentLoopData = $q['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optIndex => $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center gap-3">
                                    <!-- Radio Button for Correct Answer -->
                                    <input type="radio" name="questions[<?php echo e($index); ?>][correct_option]" value="<?php echo e($optIndex); ?>" <?php echo e($opt['is_correct'] ? 'checked' : ''); ?> class="w-5 h-5 text-green-600 focus:ring-green-500 border-gray-300 cursor-pointer" required>

                                    <!-- Option Text Input -->
                                    <input type="text" name="questions[<?php echo e($index); ?>][options][<?php echo e($optIndex); ?>]" value="<?php echo e($opt['option_text']); ?>" class="flex-1 border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 <?php echo e($opt['is_correct'] ? 'bg-green-50 font-bold' : ''); ?>" required>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-10 flex justify-between items-center pt-6 border-t border-gray-200">
                        <a href="<?php echo e(route('department.assessment.upload')); ?>" class="text-gray-500 hover:text-red-600 font-bold transition">
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\NurseCompass-Web\resources\views/department/review-assessment.blade.php ENDPATH**/ ?>