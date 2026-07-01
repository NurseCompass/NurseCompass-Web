<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Welcome to NurseCompass! Before you can access your dashboard, please provide a few details to complete your student profile.') }}
    </div>

    <form method="POST" action="/onboarding">
        @csrf

        <div>
            <x-input-label for="student_number" :value="__('Student Number')" />
            <x-text-input id="student_number" class="block mt-1 w-full" type="text" name="student_number" required autofocus placeholder="e.g., 26-12-123" />
        </div>

        <div class="mt-4">
            <x-input-label for="birthdate" :value="__('Birthdate')" />
            <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" required />
        </div>

        <div class="mt-4">
            <x-input-label for="year_level" :value="__('Year Level')" />
            <select id="year_level" name="year_level" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm" required>
                <option value="" disabled selected>Select your year level</option>
                <option value="3rd Year">3rd Year</option>
                <option value="4th Year">4th Year</option>
            </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4 bg-teal-600 hover:bg-teal-500 dark:bg-teal-500 dark:hover:bg-teal-400">
                {{ __('Complete Profile') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>