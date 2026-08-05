<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('System Administrator Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                
                <h3 class="text-2xl font-bold mb-4">Bulk Import Students</h3>
                <p class="mb-6">Upload a CSV file from the Dean's list to instantly create accounts and assign sections.</p>
                
                @if(session('success'))
                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.import.students') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label for="csv_file" class="block font-medium">Select CSV File:</label>
                        <input type="file" name="csv_file" id="csv_file" accept=".csv" required class="mt-2 block border border-gray-300 rounded p-2">
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Upload Accounts
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>