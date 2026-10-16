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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200">
                <div class="p-8">

                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-black text-red-800">Assessment Version History</h2>
                        <a href="<?php echo e(route('department.assessment.upload')); ?>" class="bg-red-800 text-white text-sm font-bold px-4 py-2 rounded-xl hover:bg-red-900 transition shadow-sm">
                            + Upload New Set
                        </a>
                    </div>

                    <p class="text-gray-600 mb-8 text-sm">View all previously uploaded question sets. If a mistake was made in the current active assessment, you can instantly restore an archived version here.</p>

                    <!-- History Table -->
                    <div class="overflow-x-auto border border-gray-200 rounded-xl">
                        <table class="w-full text-left border-collapse bg-white">
                            <thead>
                                <tr class="border-b border-gray-200 bg-gray-50 text-gray-500 text-xs font-bold uppercase tracking-wider">
                                    <th class="p-4">Year Level</th>
                                    <th class="p-4">Upload Date</th>
                                    <th class="p-4">Total Questions</th>
                                    <th class="p-4">Status</th>
                                    <th class="p-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                <?php $__empty_1 = true; $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 font-bold text-gray-900"><?php echo e($batch->year_level); ?></td>
                                    <td class="p-4 text-gray-600 font-medium"><?php echo e(\Carbon\Carbon::parse($batch->created_at)->format('M d, Y - h:i A')); ?></td>
                                    <td class="p-4 text-gray-600 font-medium"><?php echo e($batch->total_questions); ?> Questions</td>
                                    <td class="p-4">
                                        <?php if($batch->is_active): ?>
                                        <span class="px-3 py-1 bg-green-100 text-green-800 font-bold rounded-full text-xs border border-green-200">Active</span>
                                        <?php else: ?>
                                        <span class="px-3 py-1 bg-gray-100 text-gray-500 font-medium rounded-full text-xs border border-gray-200">Archived</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="p-4 text-right">
                                        <?php if(!$batch->is_active): ?>
                                        <form action="<?php echo e(route('department.assessment.restore')); ?>" method="POST" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="year_level" value="<?php echo e($batch->year_level); ?>">
                                            <input type="hidden" name="created_at" value="<?php echo e($batch->created_at); ?>">
                                            <button type="submit" class="text-xs bg-red-50 hover:bg-red-100 border border-red-200 text-red-800 font-bold px-3 py-1.5 rounded-lg transition" onclick="return confirm('Are you sure you want to restore this version? The current active questions for this year will be archived.')">
                                                Restore Set
                                            </button>
                                        </form>
                                        <?php else: ?>
                                        <span class="text-xs text-gray-400 font-medium px-3 py-1.5">Currently Live</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-gray-500 font-medium">No question history recorded yet. Upload a new PDF to start tracking versions!</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

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
<?php endif; ?><?php /**PATH C:\laragon\www\NurseCompass-Web\resources\views/department/history.blade.php ENDPATH**/ ?>