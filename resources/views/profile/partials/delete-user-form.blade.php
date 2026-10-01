<section class="space-y-6">
    <header>
        <h2 class="text-lg font-black text-slate-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" 
        class="bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-rose-600/20 text-sm tracking-wide">
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-xl font-black text-slate-900 tracking-tight">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Password') }}</label>

                <input 
                    id="password" 
                    name="password" 
                    type="password" 
                    placeholder="{{ __('Password') }}"
                    class="block w-full border border-slate-300 rounded-xl px-4 py-3.5 text-slate-900 bg-slate-50 focus:bg-white focus:border-rose-600 focus:ring-2 focus:ring-rose-100 transition shadow-sm outline-none text-sm font-medium"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-rose-600 font-medium text-xs" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-5 py-2.5 text-slate-500 font-bold hover:text-slate-800 hover:bg-slate-100 rounded-xl transition text-sm">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white font-bold py-2.5 px-6 rounded-xl transition shadow-lg shadow-rose-600/20 text-sm">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>