<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password | NurseCompass</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white m-0 p-0 min-h-screen w-full flex flex-col justify-between font-sans">

    <!-- Top Navigation Bar -->
    <header class="w-full py-5 px-8 border-b border-slate-100 flex items-center justify-between bg-white shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-teal-600 flex items-center justify-center text-white font-black text-lg shadow-md shadow-teal-600/20">
                NC
            </div>
            <span class="text-xl font-black text-slate-900 tracking-tight">Nurse<span class="text-teal-600">Compass</span></span>
        </div>
        <span class="text-xs font-bold uppercase tracking-wider text-slate-400 hidden sm:block">Predictive Workforce Readiness System</span>
    </header>

    <!-- Main Section centered with ample spacing -->
    <main class="w-full flex-grow flex items-center justify-center px-4 py-12 bg-slate-50/50">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-slate-200/80 p-8 sm:p-10">
            
            <div class="mb-6">
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Reset Password</h2>
                <p class="text-slate-500 text-sm mt-2 leading-relaxed">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-6 text-sm font-medium text-emerald-700 bg-emerald-50 p-4 rounded-xl border border-emerald-200">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">Email Address</label>
                    <input id="email" class="block w-full border border-slate-300 rounded-xl px-4 py-3.5 text-slate-900 bg-slate-50 focus:bg-white focus:border-teal-600 focus:ring-2 focus:ring-teal-100 transition shadow-sm outline-none text-sm font-medium" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="student@example.com" />
                    @error('email')
                        <p class="text-rose-600 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="pt-3">
                    <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-3.5 px-6 rounded-xl transition shadow-lg shadow-teal-600/20 text-sm tracking-wide">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>

                <div class="text-center pt-2">
                    <a href="{{ route('login') }}" class="text-xs font-semibold text-slate-500 hover:text-slate-800 transition">
                        &larr; Back to Sign In
                    </a>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full py-6 px-8 border-t border-slate-100 text-center text-xs text-slate-400 font-medium bg-white">
        Universidad de Manila — College of Nursing &copy; {{ date('Y') }}
    </footer>

</body>
</html>