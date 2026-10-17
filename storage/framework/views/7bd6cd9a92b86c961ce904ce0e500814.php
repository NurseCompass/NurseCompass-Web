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
    <!-- 1. The Header Banner (Full-width styling) -->
    <div class="bg-[#FCD34D] w-full py-4 border-b border-[#F59E0B]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-extrabold text-2xl md:text-3xl text-[#B91C1C] leading-tight tracking-wide">
                Dean's Analytics Dashboard
            </h1>
        </div>
    </div>

    <!-- 2. Main Content Area -->
    <div class="py-10 bg-white min-h-screen font-sans pb-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- NEW: Assessment Portal Management Action Card -->
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Assessment Portal Management</h3>
                    <p class="text-sm text-gray-500">Upload new assessment question sets via PDF or manage active question versions.</p>
                </div>
                <div class="flex gap-3">
                    <a href="<?php echo e(route('department.assessment.history')); ?>" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold rounded-xl transition text-sm text-center">
                        Question History
                    </a>
                    <a href="<?php echo e(route('department.assessment.upload')); ?>" class="px-4 py-2 bg-red-800 hover:bg-red-900 text-white font-bold rounded-xl transition text-sm text-center shadow-md">
                        + Upload PDF Set
                    </a>
                </div>
            </div>

            <!-- Metrics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white border-2 border-gray-200 rounded-3xl p-6 shadow-sm">
                    <h3 class="text-gray-500 text-xs font-extrabold uppercase tracking-wider">Total Registered Students</h3>
                    <p class="text-3xl font-bold text-[#B91C1C] mt-2"><?php echo e($totalStudents); ?></p>
                </div>
                <div class="bg-white border-2 border-gray-200 rounded-3xl p-6 shadow-sm">
                    <h3 class="text-gray-500 text-xs font-extrabold uppercase tracking-wider">Total Assessments Completed</h3>
                    <p class="text-3xl font-bold text-[#B91C1C] mt-2"><?php echo e($totalQuizzesTaken); ?></p>
                </div>
                <div class="bg-white border-2 border-gray-200 rounded-3xl p-6 shadow-sm">
                    <h3 class="text-gray-500 text-xs font-extrabold uppercase tracking-wider">Average Score Performance</h3>
                    <p class="text-3xl font-bold text-[#B91C1C] mt-2"><?php echo e(number_format($averageScore, 2)); ?></p>
                </div>
            </div>

            <!-- Section Overview Table -->
            <div class="bg-white border-2 border-gray-200 rounded-3xl p-6 md:p-8 shadow-sm">
                <h3 class="text-xl font-bold text-[#B91C1C] mb-6 tracking-tight">Section Performance Overview</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y-2 divide-gray-100">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-extrabold text-gray-400 uppercase tracking-wider">Section Name</th>
                                <th class="px-6 py-3 text-left text-xs font-extrabold text-gray-400 uppercase tracking-wider">Year Level</th>
                                <th class="px-6 py-3 text-left text-xs font-extrabold text-gray-400 uppercase tracking-wider">Enrolled Students</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#B91C1C]"><?php echo e($section->name); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-600"><?php echo e($section->year_level); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-600"><?php echo e($section->students_count); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
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
<?php endif; ?><?php /**PATH C:\laragon\www\NurseCompass-Web\resources\views/department/dashboard.blade.php ENDPATH**/ ?>