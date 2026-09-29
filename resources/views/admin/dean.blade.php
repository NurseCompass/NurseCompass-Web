<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Dean / Department Head') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-2xl font-bold mb-2">Department Head / Dean Accounts</h3>
                <p class="mb-6 text-gray-500 dark:text-gray-400">View accounts registered with program-level administrative access.</p>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400">
                                <th class="py-3 px-4">Name</th>
                                <th class="py-3 px-4">Email</th>
                                <th class="py-3 px-4">Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($deans as $dean)
                            <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                <td class="py-3 px-4 font-semibold">{{ $dean->name }}</td>
                                <td class="py-3 px-4">{{ $dean->email }}</td>
                                <td class="py-3 px-4"><span class="bg-purple-100 text-purple-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">Department Head / Dean</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-gray-500">No Department Head accounts found in the system.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>