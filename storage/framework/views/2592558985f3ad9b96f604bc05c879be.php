<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'NurseCompass')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-teal-50">
        <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Page Heading -->
        <?php if(isset($header)): ?>
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <?php echo e($header); ?>

            </div>
        </header>
        <?php endif; ?>

        <!-- Page Content -->
        <main>
            <?php echo e($slot); ?>

        </main>
    </div>

    <?php if(auth()->guard()->check()): ?>
    <!-- This hides the chatbot if the URL contains "quiz" -->
    <?php if (! (request()->is('quiz*'))): ?>
    <?php if (isset($component)) { $__componentOriginale2c4cac9a1edf521bb76e0ab5c886ac1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2c4cac9a1edf521bb76e0ab5c886ac1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.chat-bubble','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('chat-bubble'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale2c4cac9a1edf521bb76e0ab5c886ac1)): ?>
<?php $attributes = $__attributesOriginale2c4cac9a1edf521bb76e0ab5c886ac1; ?>
<?php unset($__attributesOriginale2c4cac9a1edf521bb76e0ab5c886ac1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale2c4cac9a1edf521bb76e0ab5c886ac1)): ?>
<?php $component = $__componentOriginale2c4cac9a1edf521bb76e0ab5c886ac1; ?>
<?php unset($__componentOriginale2c4cac9a1edf521bb76e0ab5c886ac1); ?>
<?php endif; ?>
    <?php endif; ?>
    <?php endif; ?>

</body>

</html><?php /**PATH C:\laragon\www\NurseCompass-Web\resources\views/layouts/app.blade.php ENDPATH**/ ?>