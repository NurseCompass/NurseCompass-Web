<section>
    <header>
        <h2 class="text-lg font-black text-slate-900">Update Password</h2>
        <p class="mt-1 text-sm text-slate-500">Ensure your account is using a long, random password to stay secure.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                class="block w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-900 bg-slate-50 focus:bg-white focus:border-teal-600 focus:ring-2 focus:ring-teal-100 transition shadow-sm outline-none text-sm font-medium">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-rose-600 font-medium text-xs" />
        </div>

        <div>
            <label for="update_password_password" class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">New Password</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                class="block w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-900 bg-slate-50 focus:bg-white focus:border-teal-600 focus:ring-2 focus:ring-teal-100 transition shadow-sm outline-none text-sm font-medium">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-rose-600 font-medium text-xs" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                class="block w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-900 bg-slate-50 focus:bg-white focus:border-teal-600 focus:ring-2 focus:ring-teal-100 transition shadow-sm outline-none text-sm font-medium">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-rose-600 font-medium text-xs" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-teal-600/20 text-sm tracking-wide">
                Save Password
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm font-bold text-emerald-600">Saved.</p>
            @endif
        </div>
    </form>
</section>