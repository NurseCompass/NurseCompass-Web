<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Manage Faculty') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-slate-100 min-h-screen font-sans">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Single Form Wrapping All Faculty -->
            <form action="{{ route('admin.faculty.assign') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Sticky Header with Global Save Button -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 sticky top-6 z-10">
                    <div>
                        <h1 class="text-2xl font-black text-slate-900">Assign Sections</h1>
                        <p class="text-slate-500 text-sm mt-0.5">Select sections for your faculty members and save.</p>
                    </div>
                    <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3.5 px-10 rounded-xl transition shadow-lg shadow-teal-600/20 text-sm w-full sm:w-auto shrink-0 tracking-wide">
                        Save
                    </button>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="p-4 bg-emerald-50 text-emerald-700 rounded-xl border border-emerald-200 font-bold text-sm shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Faculty Cards Grid -->
                <div class="space-y-6">
                    @forelse($facultyMembers as $faculty)
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                            <!-- Faculty Info -->
                            <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-extrabold text-slate-900">{{ $faculty->name }}</h3>
                                    <p class="text-xs font-semibold text-slate-500 mt-0.5">{{ $faculty->email }}</p>
                                </div>
                            </div>
                            
                            <!-- Section Checkboxes -->
                            <div class="p-6">
                                <div class="flex flex-wrap gap-4">
                                    @foreach($sections as $section)
                                        <label class="inline-flex items-center p-3 rounded-xl border border-slate-200 bg-white hover:border-teal-500 hover:bg-teal-50/30 transition cursor-pointer shadow-sm">
                                            <!-- Submits an array of sections grouped by the faculty ID -->
                                            <input type="checkbox" 
                                                   name="assignments[{{ $faculty->id }}][]" 
                                                   value="{{ $section->id }}" 
                                                   class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-500 rounded transition"
                                                   @if($faculty->handledSections->contains($section->id)) checked @endif>
                                            <span class="ml-3 text-sm font-semibold text-slate-700">
                                                {{ $section->name }} <span class="text-slate-400 font-medium">(Year {{ $section->year_level }})</span>
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-slate-500 font-medium bg-white rounded-2xl border border-slate-200">
                            No faculty members found in the system.
                        </div>
                    @endforelse
                </div>
                
            </form>
        </div>
    </div>
</x-app-layout>