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
    <!-- 1. The main Alpine scope wrapping the entire page contents -->
    <div x-data="{ isModalOpen: false }" class="bg-white min-h-screen font-sans pb-12">

        <!-- 2. The Header Banner (Full-width styling) -->
        <div class="bg-[#FCD34D] w-full py-4 border-b border-[#F59E0B]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="font-extrabold text-2xl md:text-3xl text-[#B91C1C] leading-tight tracking-wide">
                    Study Materials
                </h1>
            </div>
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">

            <!-- Success Alert -->
            <?php if(session('success')): ?>
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl font-medium text-sm shadow-sm">
                <?php echo e(session('success')); ?>

            </div>
            <?php endif; ?>

            <!-- Error Alert -->
            <?php if($errors->any()): ?>
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl shadow-sm">
                <p class="font-bold mb-2 text-sm">Oops! Please check the following errors:</p>
                <ul class="list-disc list-inside ml-2 text-sm font-medium">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <?php endif; ?>

            <!-- Page Action Bar -->
            <div class="bg-white rounded-3xl shadow-sm border-2 border-gray-200 p-6 md:p-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <div>
                    <h3 class="text-2xl font-bold text-[#B91C1C] tracking-tight">Available Materials</h3>
                    <p class="text-gray-500 text-sm mt-1">Access and review clinical resources, notes, and study guides.</p>
                </div>

                <button @click="isModalOpen = true" class="bg-[#0F5132] hover:bg-green-900 text-white font-bold py-3 px-8 rounded-full shadow-md transition flex items-center shrink-0 text-sm tracking-wide">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Upload New
                </button>
            </div>

            <!-- ========================================== -->
            <!-- THE UPLOADED REVIEWERS GRID                -->
            <!-- ========================================== -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__empty_1 = true; $__currentLoopData = $myReviewers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reviewer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div x-data="{ isEditModalOpen: false }" class="flex flex-col bg-white border-2 border-gray-200 rounded-3xl p-6 shadow-sm hover:shadow-md transition duration-200 group">

                    <div class="flex justify-between items-start mb-4 gap-3">
                        <a href="<?php echo e(asset('storage/' . $reviewer->file_path)); ?>" target="_blank" class="font-bold text-lg text-[#B91C1C] hover:text-red-900 transition leading-tight pr-4">
                            <?php echo e($reviewer->title); ?>

                        </a>

                        <?php if($reviewer->user_id === auth()->id()): ?>
                        <button @click="isEditModalOpen = true" class="text-[10px] font-bold uppercase tracking-wider text-white bg-[#0F5132] hover:bg-green-900 px-4 py-1.5 rounded-full flex-shrink-0 transition shadow-sm">
                            Edit
                        </button>
                        <?php endif; ?>
                    </div>

                    <div class="mb-6 flex flex-wrap gap-2">
                        <!-- Document Type Badge -->
                        <span class="inline-block bg-[#E5E5E5] text-gray-700 text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full">
                            <?php echo e($reviewer->document_type ?? 'Reading Material'); ?>

                        </span>

                        <?php if($reviewer->is_faculty_upload): ?>
                        <span class="inline-block bg-yellow-100 text-yellow-800 border border-yellow-200 text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full">
                            Official Faculty Lesson
                        </span>
                        <?php endif; ?>
                    </div>

                    <a href="<?php echo e(asset('storage/' . $reviewer->file_path)); ?>" target="_blank" class="flex items-center text-sm font-semibold text-gray-500 mt-auto hover:text-[#0F5132] transition">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Click to view document
                    </a>

                    <!-- ========================================== -->
                    <!-- THE EDIT MODAL                             -->
                    <!-- ========================================== -->
                    <div x-show="isEditModalOpen" style="display: none;" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div x-show="isEditModalOpen"
                            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            class="fixed inset-0 bg-gray-900/40 backdrop-blur-xs transition-opacity"></div>

                        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                                <div x-show="isEditModalOpen" @click.away="isEditModalOpen = false"
                                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                    class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md p-8 border border-gray-100">

                                    <h3 class="text-2xl font-bold text-[#B91C1C] mb-6">Edit Study Material</h3>

                                    <form action="<?php echo e(route('reviewers.update', $reviewer->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>

                                        <div class="mb-5">
                                            <label class="block font-extrabold text-xs uppercase tracking-wider text-[#B91C1C] mb-2">DOCUMENT TITLE</label>
                                            <input type="text" name="title" value="<?php echo e($reviewer->title); ?>" required
                                                class="block w-full border-0 rounded-xl px-4 py-3 text-gray-900 bg-[#E5E5E5] focus:bg-[#DCDCDC] transition outline-none text-sm font-semibold">
                                        </div>

                                        <div class="mb-6">
                                            <label class="block font-extrabold text-xs uppercase tracking-wider text-[#B91C1C] mb-2">DOCUMENT TYPE</label>
                                            <div class="relative">
                                                <select name="document_type" required class="block w-full border-0 rounded-xl px-4 py-3 text-gray-900 bg-[#E5E5E5] focus:bg-[#DCDCDC] transition outline-none text-sm font-semibold appearance-none cursor-pointer pr-10">
                                                    <option value="Reading Material" <?php if(($reviewer->document_type ?? 'Reading Material') == 'Reading Material'): ?> selected <?php endif; ?>>Reading Material</option>
                                                    <option value="PPT" <?php if(($reviewer->document_type ?? '') == 'PPT'): ?> selected <?php endif; ?>>PPT Presentation</option>
                                                    <option value="Syllabus" <?php if(($reviewer->document_type ?? '') == 'Syllabus'): ?> selected <?php endif; ?>>Syllabus</option>
                                                    <option value="Module" <?php if(($reviewer->document_type ?? '') == 'Module'): ?> selected <?php endif; ?>>Module</option>
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-600">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if(auth()->user()->role === 'faculty'): ?>
                                        <div class="mb-6 p-4 bg-[#E5E5E5] rounded-2xl">
                                            <label class="block font-extrabold text-xs uppercase tracking-wider text-[#B91C1C] mb-2">Assign to Sections</label>
                                            <div class="flex flex-wrap gap-3">
                                                <?php $__empty_2 = true; $__currentLoopData = $facultySections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                                <label class="inline-flex items-center p-2 rounded-lg bg-white transition cursor-pointer shadow-xs">
                                                    <input type="checkbox" name="target_sections[]" value="<?php echo e($section->name); ?>" class="w-4 h-4 text-[#0F5132] border-gray-300 focus:ring-[#0F5132] rounded"
                                                        <?php echo e(in_array($section->name, $reviewer->target_sections ?? []) ? 'checked' : ''); ?>>
                                                    <span class="ml-2 text-xs font-bold text-gray-800"><?php echo e($section->name); ?></span>
                                                </label>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                                <p class="text-xs text-gray-500 font-medium">No assigned sections.</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                        <div class="flex justify-between items-center mt-8">
                                            <button type="button" @click="isEditModalOpen = false" class="bg-[#B91C1C] hover:bg-red-800 text-white font-bold py-2.5 px-6 rounded-full transition text-sm shadow-sm">
                                                Cancel
                                            </button>
                                            <button type="submit" class="bg-[#0F5132] hover:bg-green-900 text-white font-bold py-2.5 px-6 rounded-full transition shadow-sm text-sm">
                                                Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full p-12 bg-white border-2 border-gray-200 rounded-3xl text-center shadow-sm">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border-2 border-gray-100">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#B91C1C] mb-1">No study materials yet</h3>
                    <p class="text-gray-500 text-sm font-medium">Click "Upload New" to add resources to your portal.</p>
                </div>
                <?php endif; ?>
            </div>

        </div>

        <!-- ========================================== -->
        <!-- THE UPLOAD MODAL PANEL                     -->
        <!-- ========================================== -->
        <div x-show="isModalOpen" style="display: none;" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="isModalOpen"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-900/40 backdrop-blur-xs transition-opacity"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <div x-show="isModalOpen" @click.away="isModalOpen = false"
                        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md p-8 border border-gray-100">

                        <h3 class="text-2xl font-bold text-[#B91C1C] mb-6" id="modal-title">Upload New Reviewer</h3>

                        <form action="<?php echo e(route('reviewers.store')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="mb-5">
                                <label class="block font-extrabold text-xs uppercase tracking-wider text-[#B91C1C] mb-2">DOCUMENT TITLE</label>
                                <input type="text" name="title" required placeholder="e.g. Chapter 1: Introduction to Anatomy"
                                    class="block w-full border-0 rounded-xl px-4 py-3 text-gray-900 bg-[#E5E5E5] placeholder-gray-400 focus:bg-[#DCDCDC] transition outline-none text-sm font-semibold">
                            </div>

                            <div class="mb-5">
                                <label class="block font-extrabold text-xs uppercase tracking-wider text-[#B91C1C] mb-2">DOCUMENT TYPE</label>
                                <div class="relative">
                                    <select name="document_type" required class="block w-full border-0 rounded-xl px-4 py-3 text-gray-500 focus:text-gray-900 bg-[#E5E5E5] focus:bg-[#DCDCDC] transition outline-none text-sm font-semibold appearance-none cursor-pointer pr-10">
                                        <option value="" disabled selected>Select Document Type</option>
                                        <option value="Reading Material">Reading Material</option>
                                        <option value="PPT">PPT Presentation</option>
                                        <option value="Syllabus">Syllabus</option>
                                        <option value="Module">Module</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <?php if(auth()->user()->role === 'faculty'): ?>
                            <div class="mb-5 p-4 bg-[#E5E5E5] rounded-2xl">
                                <label class="block font-extrabold text-xs uppercase tracking-wider text-[#B91C1C] mb-2">Assign to Sections</label>
                                <div class="flex flex-wrap gap-3">
                                    <?php $__empty_1 = true; $__currentLoopData = $facultySections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <label class="inline-flex items-center p-2 rounded-lg bg-white transition cursor-pointer shadow-xs">
                                        <input type="checkbox" name="target_sections[]" value="<?php echo e($section->name); ?>" class="w-4 h-4 text-[#0F5132] border-gray-300 focus:ring-[#0F5132] rounded">
                                        <span class="ml-2 text-xs font-bold text-gray-800"><?php echo e($section->name); ?></span>
                                    </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class="text-xs text-gray-500 font-medium">No assigned sections.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="mb-8">
                                <label class="block font-extrabold text-xs uppercase tracking-wider text-[#B91C1C] mb-2">FILE (PDF, DOCX, PPT)</label>
                                <div class="flex items-center bg-[#E5E5E5] rounded-xl p-1.5 overflow-hidden">
                                    <label class="bg-[#9CA3AF] hover:bg-gray-500 text-white font-bold text-xs uppercase px-4 py-2.5 rounded-lg cursor-pointer transition shrink-0">
                                        CHOOSE FILE
                                        <input type="file" name="file" required accept=".pdf,.doc,.docx,.ppt,.pptx,.txt" class="hidden" x-on:change="$dispatch('file-selected', $event.target.files[0].name)">
                                    </label>
                                    <span class="ml-3 text-xs text-gray-500 font-medium truncate" x-data="{ fileName: 'No File Chosen' }" x-on:file-selected.window="fileName = $event.detail" x-text="fileName">
                                        No File Chosen
                                    </span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <button type="button" @click="isModalOpen = false" class="bg-[#B91C1C] hover:bg-red-800 text-white font-bold py-2.5 px-6 rounded-full transition text-sm shadow-sm">
                                    Cancel
                                </button>
                                <button type="submit" class="bg-[#0F5132] hover:bg-green-900 text-white font-bold py-2.5 px-6 rounded-full transition shadow-sm text-sm">
                                    Upload Document
                                </button>
                            </div>
                        </form>
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
<?php endif; ?><?php /**PATH /var/www/capstone/NurseCompass-Web/resources/views/reviewers/index.blade.php ENDPATH**/ ?>