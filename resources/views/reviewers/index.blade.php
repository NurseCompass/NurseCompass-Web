<x-app-layout>
    <!-- 1. The main Alpine scope wrapping the entire page contents -->
    <div x-data="{ isModalOpen: false }" class="py-10 bg-slate-100 min-h-screen font-sans">

        <!-- Standard Header Slot -->
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Study Materials') }}
            </h2>
        </x-slot>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Success Alert -->
            @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl font-medium text-sm shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            <!-- Error Alert -->
            @if ($errors->any())
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl shadow-sm">
                <p class="font-bold mb-2 text-sm">Oops! Please check the following errors:</p>
                <ul class="list-disc list-inside ml-2 text-sm font-medium">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Page Action Bar -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight">Available Materials</h3>
                    <p class="text-slate-500 text-sm mt-0.5">Access and review clinical resources, notes, and study guides.</p>
                </div>

                <button @click="isModalOpen = true" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3.5 px-6 rounded-xl shadow-lg shadow-teal-600/20 transition flex items-center shrink-0 text-sm tracking-wide">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Upload New
                </button>
            </div>

            <!-- ========================================== -->
            <!-- THE UPLOADED REVIEWERS GRID                -->
            <!-- ========================================== -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($myReviewers as $reviewer)
                <div x-data="{ isEditModalOpen: false }" class="flex flex-col bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-teal-200 transition duration-200 group">

                    <div class="flex justify-between items-start mb-3 gap-3">
                        <a href="{{ asset('storage/' . $reviewer->file_path) }}" target="_blank" class="font-extrabold text-lg text-slate-900 hover:text-teal-600 transition truncate leading-tight">
                            {{ $reviewer->title }}
                        </a>

                        @if($reviewer->user_id === auth()->id())
                        <button @click="isEditModalOpen = true" class="text-[10px] font-bold uppercase tracking-wider text-teal-600 hover:text-teal-800 bg-teal-50 px-2.5 py-1.5 rounded-lg border border-teal-100 flex-shrink-0 transition">
                            Edit
                        </button>
                        @endif
                    </div>

                    <div class="mb-5 flex flex-wrap gap-2">
                        <!-- ADDED: Document Type Badge -->
                        <span class="inline-block bg-slate-100 text-slate-700 border border-slate-200 text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full">
                            {{ $reviewer->document_type ?? 'Reading Material' }}
                        </span>

                        @if($reviewer->is_faculty_upload)
                        <span class="inline-block bg-indigo-50 text-indigo-700 border border-indigo-100 text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full">
                            Official Faculty Lesson
                        </span>
                        @endif
                    </div>

                    <a href="{{ asset('storage/' . $reviewer->file_path) }}" target="_blank" class="flex items-center text-sm font-semibold text-slate-500 mt-auto hover:text-teal-600 transition">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
                            class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>

                        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                <div x-show="isEditModalOpen" @click.away="isEditModalOpen = false"
                                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200">

                                    <div class="px-6 py-6">
                                        <div class="flex justify-between items-center mb-6">
                                            <h3 class="text-xl font-black text-slate-900 tracking-tight">Edit Study Material</h3>
                                            <button @click="isEditModalOpen = false" class="text-slate-400 hover:text-slate-600 hover:bg-slate-100 p-1.5 rounded-full transition">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>

                                        <form action="{{ route('reviewers.update', $reviewer->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-5">
                                                <label class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">Document Title</label>
                                                <input type="text" name="title" value="{{ $reviewer->title }}" required
                                                    class="block w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-900 bg-slate-50 focus:bg-white focus:border-teal-600 focus:ring-2 focus:ring-teal-100 transition shadow-sm outline-none text-sm font-medium">
                                            </div>

                                            <!-- ADDED: Edit Document Type Dropdown -->
                                            <div class="mb-5">
                                                <label class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">Document Type</label>
                                                <select name="document_type" required class="block w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-900 bg-slate-50 focus:bg-white focus:border-teal-600 focus:ring-2 focus:ring-teal-100 transition shadow-sm outline-none text-sm font-medium cursor-pointer appearance-none">
                                                    <option value="Reading Material" @if(($reviewer->document_type ?? 'Reading Material') == 'Reading Material') selected @endif>Reading Material</option>
                                                    <option value="PPT" @if(($reviewer->document_type ?? '') == 'PPT') selected @endif>PPT Presentation</option>
                                                    <option value="Syllabus" @if(($reviewer->document_type ?? '') == 'Syllabus') selected @endif>Syllabus</option>
                                                    <option value="Module" @if(($reviewer->document_type ?? '') == 'Module') selected @endif>Module</option>
                                                </select>
                                            </div>

                                            @if(auth()->user()->role === 'faculty')
                                            <div class="mb-6 p-5 border border-slate-200 bg-slate-50 rounded-xl">
                                                <label class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-3">Assign to Sections <span class="normal-case font-medium text-slate-500">(Leave blank for private)</span></label>
                                                <div class="flex flex-wrap gap-4">
                                                    @forelse($facultySections as $section)
                                                    <label class="inline-flex items-center p-2.5 rounded-lg border border-slate-200 bg-white hover:border-teal-500 hover:bg-teal-50/30 transition cursor-pointer shadow-sm">
                                                        <input type="checkbox" name="target_sections[]" value="{{ $section->name }}" class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-500 rounded transition"
                                                            {{ in_array($section->name, $reviewer->target_sections ?? []) ? 'checked' : '' }}>
                                                        <span class="ml-2 text-sm font-semibold text-slate-700">{{ $section->name }}</span>
                                                    </label>
                                                    @empty
                                                    <p class="text-sm text-slate-500 font-medium">You currently have no sections assigned.</p>
                                                    @endforelse
                                                </div>
                                            </div>
                                            @endif

                                            <div class="flex justify-end border-t border-slate-100 pt-5 mt-2">
                                                <button type="button" @click="isEditModalOpen = false" class="mr-3 px-5 py-2.5 text-slate-500 font-bold hover:text-slate-800 hover:bg-slate-100 rounded-xl transition text-sm">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2.5 px-6 rounded-xl transition shadow-lg shadow-teal-600/20 text-sm">
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
                <div class="col-span-full p-12 bg-white border border-slate-200 rounded-2xl text-center shadow-sm">
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-slate-100">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-1">No study materials yet</h3>
                    <p class="text-slate-500 text-sm font-medium">Click "Upload New" to add resources to your portal.</p>
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
                class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div x-show="isModalOpen" @click.away="isModalOpen = false"
                        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200">

                        <div class="px-6 py-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-xl font-black text-slate-900 tracking-tight" id="modal-title">Upload New Reviewer</h3>
                                <button @click="isModalOpen = false" class="text-slate-400 hover:text-slate-600 hover:bg-slate-100 p-1.5 rounded-full transition">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <form action="{{ route('reviewers.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-5">
                                    <label class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">Document Title</label>
                                    <input type="text" name="title" required placeholder="e.g., Chapter 1: Introduction to Anatomy"
                                        class="block w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-900 bg-slate-50 focus:bg-white focus:border-teal-600 focus:ring-2 focus:ring-teal-100 transition shadow-sm outline-none text-sm font-medium">
                                </div>

                                <!-- ADDED: Upload Document Type Dropdown -->
                                <div class="mb-5">
                                    <label class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">Document Type</label>
                                    <select name="document_type" required class="block w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-900 bg-slate-50 focus:bg-white focus:border-teal-600 focus:ring-2 focus:ring-teal-100 transition shadow-sm outline-none text-sm font-medium cursor-pointer appearance-none">
                                        <option value="" disabled selected>Select document type...</option>
                                        <option value="Reading Material">Reading Material</option>
                                        <option value="PPT">PPT Presentation</option>
                                        <option value="Syllabus">Syllabus</option>
                                        <option value="Module">Module</option>
                                    </select>
                                </div>

                                @if(auth()->user()->role === 'faculty')
                                <div class="mb-5 p-5 border border-slate-200 bg-slate-50 rounded-xl">
                                    <label class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-3">Assign to Sections <span class="normal-case font-medium text-slate-500">(Leave blank for private)</span></label>
                                    <div class="flex flex-wrap gap-4">
                                        @forelse($facultySections as $section)
                                        <label class="inline-flex items-center p-2.5 rounded-lg border border-slate-200 bg-white hover:border-teal-500 hover:bg-teal-50/30 transition cursor-pointer shadow-sm">
                                            <input type="checkbox" name="target_sections[]" value="{{ $section->name }}" class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-500 rounded transition">
                                            <span class="ml-2 text-sm font-semibold text-slate-700">{{ $section->name }}</span>
                                        </label>
                                        @empty
                                        <p class="text-sm text-slate-500 font-medium">You currently have no sections assigned.</p>
                                        @endforelse
                                    </div>
                                </div>
                                @endif

                                <div class="mb-6">
                                    <label class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">File <span class="normal-case font-medium text-slate-500">(PDF, DOCX, PPT)</span></label>
                                    <input type="file" name="file" required accept=".pdf,.doc,.docx,.ppt,.pptx,.txt"
                                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition cursor-pointer bg-white border border-slate-200 rounded-xl shadow-sm focus:outline-none">
                                </div>

                                <div class="flex justify-end border-t border-slate-100 pt-5 mt-2">
                                    <button type="button" @click="isModalOpen = false" class="mr-3 px-5 py-2.5 text-slate-500 font-bold hover:text-slate-800 hover:bg-slate-100 rounded-xl transition text-sm">
                                        Cancel
                                    </button>
                                    <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2.5 px-6 rounded-xl transition shadow-lg shadow-teal-600/20 text-sm">
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