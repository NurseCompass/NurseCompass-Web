<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200">
                <div class="p-8 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-black text-red-800 mb-2">Upload New Assessment Questions</h2>
                    <p class="text-gray-600 mb-8">Upload a PDF containing the new questions. The AI will extract and format them for your review before making them live.</p>

                    <form action="{{ route('department.assessment.parse') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Target Year Level -->
                        <div class="mb-6">
                            <label for="year_level" class="block text-sm font-bold text-gray-700 mb-2">Target Year Level</label>
                            <select name="year_level" id="year_level" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500" required>
                                <option value="" disabled selected>Select year level to update...</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                        </div>

                        <!-- PDF Upload -->
                        <div class="mb-8">
                            <label for="pdf_file" class="block text-sm font-bold text-gray-700 mb-2">Assessment File (PDF only)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-red-500 transition">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="pdf_file" class="relative cursor-pointer bg-white rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-red-500">
                                            <span>Upload a file</span>
                                            <input id="pdf_file" name="pdf_file" type="file" accept=".pdf" class="sr-only" required>
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF up to 10MB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-red-800 hover:bg-red-900 text-white px-8 py-3 rounded-xl font-bold transition shadow-md">
                                Extract Questions with AI
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>