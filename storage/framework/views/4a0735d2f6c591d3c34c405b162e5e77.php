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
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200">
                <div class="p-8 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-black text-red-800 mb-2">Upload New Assessment Questions</h2>
                    <p class="text-gray-600 mb-8">Upload a PDF containing the new questions. The AI will extract and format them for your review before making them live.</p>

                    <!-- ERROR DISPLAY MESSAGES -->
                    <?php if($errors->any()): ?>
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-600 rounded-r-xl text-red-800">
                        <ul class="list-disc list-inside text-sm font-bold">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-600 rounded-r-xl text-red-800 text-sm font-bold">
                        <?php echo e(session('error')); ?>

                    </div>
                    <?php endif; ?>
                    <!-- END ERROR DISPLAY -->

                    <form action="<?php echo e(route('department.assessment.parse')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <!-- Target Year Level -->
                        <div class="mb-6">
                            <label for="year_level" class="block text-sm font-bold text-gray-700 mb-2">Target Year Level</label>
                            <select name="year_level" id="year_level" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500" required>
                                <option value="" disabled selected>Select year level to update...</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                        </div>

                        <!-- PDF Upload -->
                        <div class="mb-8">
                            <label for="pdf_file" class="block text-sm font-bold text-gray-700 mb-2">Assessment File (PDF only)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-red-500 transition" id="drop-zone">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="pdf_file" class="relative cursor-pointer bg-white rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-red-500">
                                            <!-- Dynamic File Name Display -->
                                            <span id="file-name-display">Upload a file</span>
                                            <input id="pdf_file" name="pdf_file" type="file" accept=".pdf" class="sr-only" required onchange="document.getElementById('file-name-display').innerText = this.files[0] ? this.files[0].name : 'Upload a file'">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF up to 10MB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button id="submit-btn" type="submit" class="bg-red-800 hover:bg-red-900 text-white px-8 py-3 rounded-xl font-bold transition shadow-md flex items-center gap-2" onclick="this.innerHTML='<svg class=\'animate-spin h-5 w-5 text-white\' xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 24 24\'><circle class=\'opacity-25\' cx=\'12\' cy=\'12\' r=\'10\' stroke=\'currentColor\' stroke-width=\'4\'></circle><path class=\'opacity-75\' fill=\'currentColor\' d=\'M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z\'></path></svg> Extracting...';">
                                Extract Questions with AI
                            </button>
                        </div>
                    </form>
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
<?php endif; ?><?php /**PATH C:\laragon\www\NurseCompass-Web\resources\views/department/upload-assessment.blade.php ENDPATH**/ ?>