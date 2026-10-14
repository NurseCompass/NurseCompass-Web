<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In | NurseCompass</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F8F9FA] m-0 p-0 min-h-screen w-full flex flex-col font-sans">

    <!-- Top Navigation Bar (Matched to Figma Header) -->
    <!-- Top Navigation Bar (Matched to Figma Header) -->
    <header class="w-full py-4 px-8 bg-white border-b-2 border-red-800 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-3">
            <!-- Adjusted Logo (No forced circle formatting) -->
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
                <h2 class="text-3xl font-bold text-red-800">Sign In</h2>
                <p class="text-gray-500 text-sm mt-2">Access your nursing assessment and review portal.</p>
            </div>

            <!-- Session Status -->
            <?php if(session('status')): ?>
            <div class="mb-6 text-sm font-medium text-emerald-700 bg-emerald-50 p-4 rounded-xl border border-emerald-200">
                <?php echo e(session('status')); ?>

            </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>

                <!-- Student Number or Email Address -->
                <div class="mb-5">
                    <label for="email" class="block font-bold text-xs tracking-wider text-red-800 mb-2">
                        Student Number or Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <!-- Solid User Icon -->
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input id="email" class="block w-full border-none rounded-lg pl-10 pr-4 py-3.5 text-gray-900 bg-gray-100 focus:bg-white focus:ring-2 focus:ring-red-800 transition outline-none text-sm font-medium" type="text" name="email" value="<?php echo e(old('email')); ?>" required autofocus autocomplete="username" />
                    </div>
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

                <!-- Password -->
                <div class="mb-5">
                    <label for="password" class="block font-bold text-xs tracking-wider text-red-800 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <!-- Solid Lock Icon -->
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input id="password" class="block w-full border-none rounded-lg pl-10 pr-10 py-3.5 text-gray-900 bg-gray-100 focus:bg-white focus:ring-2 focus:ring-red-800 transition outline-none text-sm font-medium" type="password" name="password" required autocomplete="current-password" />

                        <!-- Eye Slash Icon -->
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                            <svg class="h-5 w-5 text-gray-400 hover:text-gray-600 transition" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                                <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                            </svg>
                        </div>
                    </div>
                    <?php $__errorArgs = ['password'];
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

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between text-sm mt-5 mb-6">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-800 focus:ring-red-800 shadow-sm w-4 h-4" name="remember">
                        <span class="ms-2 font-medium text-gray-700 text-sm">Remember Me</span>
                    </label>

                    <?php if(Route::has('password.request')): ?>
                    <a class="font-medium text-sm text-red-800 hover:underline transition" href="<?php echo e(route('password.request')); ?>">
                        Forgot Password?
                    </a>
                    <?php endif; ?>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full bg-red-800 hover:bg-red-900 text-white font-bold py-3.5 px-6 rounded-lg transition text-sm tracking-wide shadow-md">
                        Sign In to Portal
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>

</html><?php /**PATH C:\laragon\www\NurseCompass-Web\resources\views/auth/login.blade.php ENDPATH**/ ?>