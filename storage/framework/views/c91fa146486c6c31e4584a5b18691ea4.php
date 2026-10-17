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
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <?php echo e(__('Manage Students')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <?php if(session('success')): ?>
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-green-900/20 dark:text-green-400">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <!-- 1. BULK IMPORT CARD -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-2xl font-bold mb-2">Bulk Import Students</h3>
                <p class="mb-6 text-gray-500 dark:text-gray-400">Upload a CSV file from the Dean's list to instantly create accounts and assign sections.</p>
                
                <form action="<?php echo e(route('admin.import.students')); ?>" method="POST" enctype="multipart/form-data" class="space-y-4 flex items-end gap-4">
                    <?php echo csrf_field(); ?>
                    <div class="flex-grow">
                        <label for="csv_file" class="block font-medium mb-1">Select CSV File:</label>
                        <input type="file" name="csv_file" id="csv_file" accept=".csv" required class="block w-full border border-gray-300 dark:border-gray-600 rounded p-2 dark:bg-gray-900">
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">
                        Upload Accounts
                    </button>
                </form>
            </div>

            <!-- 2. ADD SINGLE STUDENT CARD -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-2xl font-bold mb-2">Add Single Student</h3>
                <p class="mb-6 text-gray-500 dark:text-gray-400">Manually register a single student account to the system.</p>

                <form action="<?php echo e(route('admin.store.student')); ?>" method="POST" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium mb-1">Full Name:</label>
                            <input type="text" name="name" required placeholder="Juan Dela Cruz" class="block w-full border border-gray-300 dark:border-gray-600 rounded p-2 dark:bg-gray-900">
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Email:</label>
                            <input type="email" name="email" required placeholder="juan@example.com" class="block w-full border border-gray-300 dark:border-gray-600 rounded p-2 dark:bg-gray-900">
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Student Number:</label>
                            <input type="text" name="student_number" required placeholder="2023-12345" class="block w-full border border-gray-300 dark:border-gray-600 rounded p-2 dark:bg-gray-900">
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Birthdate:</label>
                            <input type="date" name="birthdate" required class="block w-full border border-gray-300 dark:border-gray-600 rounded p-2 dark:bg-gray-900">
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Year Level:</label>
                            <input type="number" name="year_level" min="1" max="4" required placeholder="3" class="block w-full border border-gray-300 dark:border-gray-600 rounded p-2 dark:bg-gray-900">
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Section Name:</label>
                            <input type="text" name="section_name" required placeholder="BSN 3-1" class="block w-full border border-gray-300 dark:border-gray-600 rounded p-2 dark:bg-gray-900">
                        </div>
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-6 rounded transition">
                            Register Student
                        </button>
                    </div>
                </form>
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
<?php endif; ?><?php /**PATH C:\laragon\www\NurseCompass-Web\resources\views/admin/students.blade.php ENDPATH**/ ?>