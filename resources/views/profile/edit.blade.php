<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Account Settings') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-slate-100 min-h-screen font-sans">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- Page Header -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight">Profile & Security</h1>
                    <p class="text-slate-500 text-sm mt-0.5">Manage your account information, password, and security preferences.</p>
                </div>
            </div>

            <!-- Profile Info Form -->
            <div class="p-6 sm:p-10 bg-white border border-slate-200 shadow-sm rounded-2xl">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password Update Form -->
            <div class="p-6 sm:p-10 bg-white border border-slate-200 shadow-sm rounded-2xl">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete User Form -->
            <div class="p-6 sm:p-10 bg-white border border-slate-200 shadow-sm rounded-2xl">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>