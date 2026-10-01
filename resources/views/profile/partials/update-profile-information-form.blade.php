<section>
    <header>
        <h2 class="text-lg font-black text-slate-900">Profile Information</h2>
        <p class="mt-1 text-sm text-slate-500">Update your account's profile information and email address.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <label for="name" class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                class="block w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-900 bg-slate-50 focus:bg-white focus:border-teal-600 focus:ring-2 focus:ring-teal-100 transition shadow-sm outline-none text-sm font-medium">
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">Email Address</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                class="block w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-900 bg-slate-50 focus:bg-white focus:border-teal-600 focus:ring-2 focus:ring-teal-100 transition shadow-sm outline-none text-sm font-medium">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- Student Number (If applicable) -->
        <div>
            <label for="student_number" class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">Student Number</label>
            <input id="student_number" name="student_number" type="text" value="{{ old('student_number', $user->student_number) }}"
                class="block w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-900 bg-slate-50 focus:bg-white focus:border-teal-600 focus:ring-2 focus:ring-teal-100 transition shadow-sm outline-none text-sm font-medium">
            <x-input-error class="mt-2" :messages="$errors->get('student_number')" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Birthdate -->
            <div>
                <label for="birthdate" class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">Birthdate</label>
                <input id="birthdate" name="birthdate" type="date" value="{{ old('birthdate', $user->birthdate) }}"
                    class="block w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-900 bg-slate-50 focus:bg-white focus:border-teal-600 focus:ring-2 focus:ring-teal-100 transition shadow-sm outline-none text-sm font-medium">
                <x-input-error class="mt-2" :messages="$errors->get('birthdate')" />
            </div>

            <!-- Year Level -->
            <div>
                <label for="year_level" class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">Year Level</label>
                <input id="year_level" name="year_level" type="text" value="{{ old('year_level', $user->year_level) }}"
                    class="block w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-900 bg-slate-50 focus:bg-white focus:border-teal-600 focus:ring-2 focus:ring-teal-100 transition shadow-sm outline-none text-sm font-medium">
                <x-input-error class="mt-2" :messages="$errors->get('year_level')" />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-teal-600/20 text-sm tracking-wide">
                Save Changes
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm font-bold text-emerald-600">Saved.</p>
            @endif
        </div>
    </form>
</section>