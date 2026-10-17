<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-black text-red-800">Assessment Version History</h2>
                        <a href="{{ route('department.assessment.upload') }}" class="bg-red-800 text-white text-sm font-bold px-4 py-2 rounded-xl hover:bg-red-900 transition shadow-sm">
                            + Upload New Set
                        </a>
                    </div>
                    <p class="text-gray-600 mb-8 text-sm">View all previously uploaded question sets and restore archived versions.</p>

                    <div class="overflow-x-auto border border-gray-200 rounded-xl">
                        <table class="w-full text-left border-collapse bg-white">
                            <thead>
                                <tr class="border-b border-gray-200 bg-gray-50 text-gray-500 text-xs font-bold uppercase tracking-wider">
                                    <th class="p-4">Year Level</th>
                                    <th class="p-4">Upload Date</th>
                                    <th class="p-4">Total Questions</th>
                                    <th class="p-4">Status</th>
                                    <th class="p-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                @forelse ($history as $batch)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 font-bold text-gray-900">{{ $batch->year_level }}</td>
                                    <td class="p-4 text-gray-600 font-medium">{{ \Carbon\Carbon::parse($batch->created_at)->format('M d, Y - h:i A') }}</td>
                                    <td class="p-4 text-gray-600 font-medium">{{ $batch->total_questions }} Questions</td>
                                    <td class="p-4">
                                        @if($batch->is_active)
                                        <span class="px-3 py-1 bg-green-100 text-green-800 font-bold rounded-full text-xs border border-green-200">Active</span>
                                        @else
                                        <span class="px-3 py-1 bg-gray-100 text-gray-500 font-medium rounded-full text-xs border border-gray-200">Archived</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-right">
                                        @if(!$batch->is_active)
                                        <form action="{{ route('department.assessment.restore') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="year_level" value="{{ $batch->year_level }}">
                                            <input type="hidden" name="created_at" value="{{ $batch->created_at }}">
                                            <button type="submit" class="text-xs bg-red-50 hover:bg-red-100 border border-red-200 text-red-800 font-bold px-3 py-1.5 rounded-lg transition" onclick="return confirm('Are you sure you want to restore this version?')">
                                                Restore Set
                                            </button>
                                        </form>
                                        @else
                                        <span class="text-xs text-gray-400 font-medium px-3 py-1.5">Currently Live</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-gray-500 font-medium">No question history recorded yet. Upload a new PDF to start tracking versions!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>