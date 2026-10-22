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
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            <?php echo e(__('Manage Faculty')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-10 bg-slate-100 min-h-screen font-sans">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Single Form Wrapping All Faculty -->
            <form action="<?php echo e(route('admin.faculty.assign')); ?>" method="POST" class="space-y-6">
                <?php echo csrf_field(); ?>
                
                <!-- Sticky Header with Global Save Button -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 sticky top-6 z-10">
                    <div>
                        <h1 class="text-2xl font-black text-slate-900">Assign Sections</h1>
                        <p class="text-slate-500 text-sm mt-0.5">Select sections for your faculty members and save.</p>
                    </div>
                    <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3.5 px-10 rounded-xl transition shadow-lg shadow-teal-600/20 text-sm w-full sm:w-auto shrink-0 tracking-wide">
                        Save
                    </button>
                </div>

                <!-- Success Message -->
                <?php if(session('success')): ?>
                    <div class="p-4 bg-emerald-50 text-emerald-700 rounded-xl border border-emerald-200 font-bold text-sm shadow-sm">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <!-- Faculty Cards Grid -->
                <div class="space-y-6">
                    <?php $__empty_1 = true; $__currentLoopData = $facultyMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faculty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                            <!-- Faculty Info -->
                            <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-extrabold text-slate-900"><?php echo e($faculty->name); ?></h3>
                                    <p class="text-xs font-semibold text-slate-500 mt-0.5"><?php echo e($faculty->email); ?></p>
                                </div>
                            </div>
                            
                            <!-- Section Checkboxes -->
                            <div class="p-6">
                                <div class="flex flex-wrap gap-4">
                                    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <label class="inline-flex items-center p-3 rounded-xl border border-slate-200 bg-white hover:border-teal-500 hover:bg-teal-50/30 transition cursor-pointer shadow-sm">
                                            <!-- Submits an array of sections grouped by the faculty ID -->
                                            <input type="checkbox" 
                                                   name="assignments[<?php echo e($faculty->id); ?>][]" 
                                                   value="<?php echo e($section->id); ?>" 
                                                   class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-500 rounded transition"
                                                   <?php if($faculty->handledSections->contains($section->id)): ?> checked <?php endif; ?>>
                                            <span class="ml-3 text-sm font-semibold text-slate-700">
                                                <?php echo e($section->name); ?> <span class="text-slate-400 font-medium">(Year <?php echo e($section->year_level); ?>)</span>
                                            </span>
                                        </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="p-6 text-center text-slate-500 font-medium bg-white rounded-2xl border border-slate-200">
                            No faculty members found in the system.
                        </div>
                    <?php endif; ?>
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
<?php endif; ?><?php /**PATH /var/www/capstone/NurseCompass-Web/resources/views/admin/faculty.blade.php ENDPATH**/ ?>