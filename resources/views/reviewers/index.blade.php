<x-app-layout>
    <!-- 1. The main Alpine scope wrapping the entire page contents -->
    <div x-data="{ isModalOpen: false }" class="py-12">
        
        <!-- Standard Header Slot (Clean and empty of broken buttons) -->
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Study Materials') }}
            </h2>
        </x-slot>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Page Action Bar (Where the button actually works safely!) -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Available Materials</h3>
                
                <!-- This button is 100% inside the x-data scope, so it will work instantly -->
                <button @click="isModalOpen = true" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition duration-150 flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                    Upload New
                </button>
            </div>

            <!-- ========================================== -->
            <!-- THE UPLOADED REVIEWERS GRID                -->
            <!-- ========================================== -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($myReviewers as $reviewer)
                    <div x-data="{ isEditModalOpen: false }" class="flex flex-col bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-5 shadow-sm hover:shadow-md transition duration-150 group">
                        
                        <div class="flex justify-between items-start mb-3">
                            <a href="{{ asset('storage/' . $reviewer->file_path) }}" target="_blank" class="font-bold text-lg text-gray-900 dark:text-gray-100 hover:text-teal-600 transition truncate pr-2">
                                {{ $reviewer->title }}
                            </a>
                            
                            @if($reviewer->user_id === auth()->id())
                                <button @click="isEditModalOpen = true" class="text-xs font-semibold text-teal-600 hover:text-teal-800 dark:text-teal-400 dark:hover:text-teal-300 bg-teal-50 dark:bg-gray-700 px-2 py-1 rounded border border-teal-200 dark:border-gray-600 flex-shrink-0 transition">
                                    Edit
                                </button>
                            @endif
                        </div>
                        
                        <div class="mb-4">
                            <span class="inline-block bg-teal-100 text-teal-800 text-xs font-bold px-2.5 py-0.5 rounded dark:bg-teal-900 dark:text-teal-300 mb-2">
                                {{ $reviewer->category }}
                            </span>
                            
                            @if($reviewer->is_faculty_upload)
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 mb-2 ml-1">
                                    Official Faculty Lesson
                                </span>
                            @endif
                        </div>
                        
                        <a href="{{ asset('storage/' . $reviewer->file_path) }}" target="_blank" class="flex items-center text-sm text-gray-500 dark:text-gray-400 mt-auto hover:text-teal-600 transition">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Click to view document
                        </a>

                        <!-- ========================================== -->
                        <!-- THE EDIT MODAL                             -->
                        <!-- ========================================== -->
                        <div x-show="isEditModalOpen" style="display: none;" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                            <div x-show="isEditModalOpen" 
                                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                 class="fixed inset-0 bg-gray-500/75 dark:bg-gray-900/80 transition-opacity"></div>

                            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                    <div x-show="isEditModalOpen" @click.away="isEditModalOpen = false"
                                         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                         class="relative transform overflow-hidden rounded-xl bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-200 dark:border-gray-700">
                                        
                                        <div class="px-6 py-5">
                                            <div class="flex justify-between items-center mb-5">
                                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Edit Study Material</h3>
                                                <button @click="isEditModalOpen = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition">
                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            
                                            <form action="{{ route('reviewers.update', $reviewer->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                
                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Document Title</label>
                                                    <input type="text" name="title" value="{{ $reviewer->title }}" required 
                                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:bg-gray-900 dark:border-gray-600 dark:text-white">
                                                </div>

                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                                                    <select name="category" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:bg-gray-900 dark:border-gray-600 dark:text-white">
                                                        <option value="Academic Performance" {{ $reviewer->category == 'Academic Performance' ? 'selected' : '' }}>Academic Performance</option>
                                                        <option value="Self-Efficacy" {{ $reviewer->category == 'Self-Efficacy' ? 'selected' : '' }}>Self-Efficacy</option>
                                                        <option value="Initiative" {{ $reviewer->category == 'Initiative' ? 'selected' : '' }}>Initiative</option>
                                                        <option value="Motivation" {{ $reviewer->category == 'Motivation' ? 'selected' : '' }}>Motivation</option>
                                                    </select>
                                                </div>

                                                @if(auth()->user()->role === 'faculty')
                                                    @php
                                                        $assignedSections = $reviewer->target_sections ?? [];
                                                    @endphp
                                                    <div class="mb-6 p-4 border border-blue-200 bg-blue-50 dark:bg-blue-900/20 dark:border-blue-800 rounded-lg">
                                                        <label class="block text-sm font-bold text-blue-800 dark:text-blue-300 mb-2">Assign to Sections</label>
                                                        <div class="flex flex-wrap gap-4">
                                                            <label class="inline-flex items-center">
                                                                <input type="checkbox" name="target_sections[]" value="BSN 3-1" {{ in_array('BSN 3-1', $assignedSections) ? 'checked' : '' }} class="text-blue-600 rounded">
                                                                <span class="ml-2 text-gray-700 dark:text-gray-300 text-sm">BSN 3-1</span>
                                                            </label>
                                                            <label class="inline-flex items-center">
                                                                <input type="checkbox" name="target_sections[]" value="BSN 3-2" {{ in_array('BSN 3-2', $assignedSections) ? 'checked' : '' }} class="text-blue-600 rounded">
                                                                <span class="ml-2 text-gray-700 dark:text-gray-300 text-sm">BSN 3-2</span>
                                                            </label>
                                                            <label class="inline-flex items-center">
                                                                <input type="checkbox" name="target_sections[]" value="BSN 4-1" {{ in_array('BSN 4-1', $assignedSections) ? 'checked' : '' }} class="text-blue-600 rounded">
                                                                <span class="ml-2 text-gray-700 dark:text-gray-300 text-sm">BSN 4-1</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="flex justify-end border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                                                    <button type="button" @click="isEditModalOpen = false" class="mr-3 px-4 py-2 text-gray-700 dark:text-gray-300 font-medium hover:text-gray-900 dark:hover:text-white transition">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-6 rounded-lg transition duration-150 shadow-sm">
                                                        Save Changes
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full p-6 bg-gray-50 dark:bg-gray-800 border border-dashed border-gray-300 dark:border-gray-600 rounded-xl text-center">
                        <p class="text-gray-500 dark:text-gray-400">You haven't uploaded any study materials yet. Click "Upload New" to get started!</p>
                    </div>
                @endforelse
            </div>

        </div>

        <!-- ========================================== -->
        <!-- THE UPLOAD MODAL PANEL                     -->
        <!-- ========================================== -->
        <div x-show="isModalOpen" style="display: none;" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="isModalOpen" 
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-500/75 dark:bg-gray-900/80 transition-opacity"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div x-show="isModalOpen" @click.away="isModalOpen = false"
                         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                         class="relative transform overflow-hidden rounded-xl bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-200 dark:border-gray-700">
                        
                        <div class="px-6 py-5">
                            <div class="flex justify-between items-center mb-5">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100" id="modal-title">Upload a New Reviewer</h3>
                                <button @click="isModalOpen = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            
                            <form action="{{ route('reviewers.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Document Title</label>
                                    <input type="text" name="title" required placeholder="e.g., Chapter 1: Introduction to AI" 
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:bg-gray-900 dark:border-gray-600 dark:text-white">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category (For Recommendations)</label>
                                    <select name="category" required 
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:bg-gray-900 dark:border-gray-600 dark:text-white">
                                        <option value="" disabled selected>Select a category...</option>
                                        <option value="Academic Performance">Academic Performance</option>
                                        <option value="Self-Efficacy">Self-Efficacy</option>
                                        <option value="Initiative">Initiative</option>
                                        <option value="Motivation">Motivation</option>
                                    </select>
                                </div>

                                @if(auth()->user()->role === 'faculty')
                                    <div class="mb-4 p-4 border border-blue-200 bg-blue-50 dark:bg-blue-900/20 dark:border-blue-800 rounded-lg">
                                        <label class="block text-sm font-bold text-blue-800 dark:text-blue-300 mb-2">Assign to Sections (Leave blank for private)</label>
                                        <div class="flex flex-wrap gap-4">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" name="target_sections[]" value="BSN 3-1" class="text-blue-600 rounded border-gray-300">
                                                <span class="ml-2 text-gray-700 dark:text-gray-300 text-sm">BSN 3-1</span>
                                            </label>
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" name="target_sections[]" value="BSN 3-2" class="text-blue-600 rounded border-gray-300">
                                                <span class="ml-2 text-gray-700 dark:text-gray-300 text-sm">BSN 3-2</span>
                                            </label>
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" name="target_sections[]" value="BSN 4-1" class="text-blue-600 rounded border-gray-300">
                                                <span class="ml-2 text-gray-700 dark:text-gray-300 text-sm">BSN 4-1</span>
                                            </label>
                                        </div>
                                    </div>
                                @endif

                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">File (PDF, DOCX, PPT)</label>
                                    <input type="file" name="file" required accept=".pdf,.doc,.docx,.ppt,.pptx,.txt"
                                        class="w-full text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 dark:file:bg-teal-900 dark:file:text-teal-300 cursor-pointer">
                                </div>

                                <div class="flex justify-end border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                                    <button type="button" @click="isModalOpen = false" class="mr-3 px-4 py-2 text-gray-700 dark:text-gray-300 font-medium hover:text-gray-900 dark:hover:text-white transition">
                                        Cancel
                                    </button>
                                    <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-6 rounded-lg transition duration-150 shadow-sm">
                                        Upload Document
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>