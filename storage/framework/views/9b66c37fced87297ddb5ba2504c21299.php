<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password | NurseCompass</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F8F9FA] m-0 p-0 min-h-screen w-full flex flex-col font-sans">

    <!-- Top Navigation Bar (Matched to Figma Header) -->
    <header class="w-full py-4 px-8 bg-white border-b-2 border-red-800 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-3">
            <img src="<?php echo e(asset('images/UDM-CHS logo.png')); ?>" alt="UDM Logo" class="h-10 w-auto object-contain" />
            <span class="text-2xl font-bold text-red-800 tracking-tight">NurseCompass</span>
        </div>
        <div class="hidden sm:block">
            <span class="text-sm font-bold uppercase tracking-wider text-red-800">Predictive Workforce Readiness System</span>
        </div>
    </header>

    <!-- Main Section (Centered Card) -->
    <main class="w-full flex-grow flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-[450px] bg-white rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] p-8 sm:p-10">

            <div class="mb-8 text-center">
                <h2 class="text-3xl font-bold text-red-800">Reset Password</h2>
                <p class="text-gray-500 text-sm mt-3 leading-relaxed">
                    Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </p>
            </div>

            <!-- Session Status -->
            <?php if(session('status')): ?>
            <div class="mb-6 text-sm font-medium text-emerald-700 bg-emerald-50 p-4 rounded-xl border border-emerald-200">
                <?php echo e(session('status')); ?>

            </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('password.email')); ?>">
                <?php echo csrf_field(); ?>

                <!-- Email Address -->
                <div class="mb-6">
                    <label for="email" class="block font-bold text-xs uppercase tracking-wider text-red-800 mb-2">
                        Email Address
                    </label>
                    <input id="email" class="block w-full border-none rounded-lg px-4 py-3.5 text-gray-900 bg-gray-100 focus:bg-white focus:ring-2 focus:ring-red-800 transition outline-none text-sm font-medium" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus />
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-xs mt-1.5 font-semibold"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full bg-red-800 hover:bg-red-900 text-white font-bold py-3.5 px-6 rounded-lg transition text-sm tracking-wide shadow-md">
                        Confirm
                    </button>
                </div>
                
                <!-- Back to Sign In -->
                <div class="mt-6 text-center">
                    <a href="<?php echo e(route('login')); ?>" class="inline-flex items-center text-sm font-bold text-red-800 hover:text-red-900 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Sign In
                    </a>
                </div>
            </form>
        </div>
    </main>

</body>

</html><?php /**PATH C:\laragon\www\NurseCompass-Web\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>