<x-apps.app-employer>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center py-1 px-4 gap-2">
            <div class="ml-2">
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    Create <span class="text-[#a31b1b]">Job Post</span>
                </h2>
                <p class="text-gray-400 text-sm font-medium">Publish a new job opportunity</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('employer.jobs.index') }}" class="inline-flex items-center gap-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-sm no-underline">
                    <i class="bi bi-arrow-left text-lg"></i>
                    Back to Jobs
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50/50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 md:p-10">
                    {{-- Validation Errors Summary --}}
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                            <p class="font-bold mb-2">Please fix the following errors:</p>
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('employer.jobs.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <input type="hidden" name="id_employeur" value="{{ auth()->user()->id }}"/>
                
                        <!-- Grid 2 cols for shorter inputs -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Job Title -->
                            <div class="col-span-1 md:col-span-2">
                                <label for="titre" class="block text-sm font-bold text-gray-700 mb-2">Job Title</label>
                                <input type="text" id="titre" name="titre" value="{{ old('titre') }}" required
                                    class="w-full bg-gray-50 border {{ $errors->has('titre') ? 'border-red-400' : 'border-gray-200' }} text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                                @error('titre') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Location -->
                            <div>
                                <label for="location" class="block text-sm font-bold text-gray-700 mb-2">Location</label>
                                <input type="text" id="location" name="location" value="{{ old('location') }}" required
                                    class="w-full bg-gray-50 border {{ $errors->has('location') ? 'border-red-400' : 'border-gray-200' }} text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                                @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Salary -->
                            <div>
                                <label for="salaire" class="block text-sm font-bold text-gray-700 mb-2">Salary Estimate</label>
                                <input type="number" step="0.01" id="salaire" name="salaire" value="{{ old('salaire') }}" placeholder="e.g. 50000"
                                    class="w-full bg-gray-50 border {{ $errors->has('salaire') ? 'border-red-400' : 'border-gray-200' }} text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                                @error('salaire') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Job Type -->
                            <div>
                                <label for="type" class="block text-sm font-bold text-gray-700 mb-2">Employment Type</label>
                                <select id="type" name="job_type" required
                                    class="w-full bg-gray-50 border {{ $errors->has('job_type') ? 'border-red-400' : 'border-gray-200' }} text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                                    <option value="" disabled {{ old('job_type') ? '' : 'selected' }}>Select employment type</option>
                                    <option value="Full Time" {{ old('job_type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                    <option value="Part Time" {{ old('job_type') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                    <option value="Internship" {{ old('job_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                                </select>
                                @error('job_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category" class="block text-sm font-bold text-gray-700 mb-2">Category</label>
                                <select id="category" name="categorie" required
                                    class="w-full bg-gray-50 border {{ $errors->has('categorie') ? 'border-red-400' : 'border-gray-200' }} text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                                    <option value="" disabled {{ old('categorie') ? '' : 'selected' }}>Select category</option>
                                    <option value="tech" {{ old('categorie') == 'tech' ? 'selected' : '' }}>Technology</option>
                                    <option value="sells" {{ old('categorie') == 'sells' ? 'selected' : '' }}>Sales</option>
                                    <option value="marketing" {{ old('categorie') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                                    <option value="finance" {{ old('categorie') == 'finance' ? 'selected' : '' }}>Finance</option>
                                    <option value="education" {{ old('categorie') == 'education' ? 'selected' : '' }}>Education</option>
                                    <option value="other" {{ old('categorie') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('categorie') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Contract Type -->
                            <div>
                                <label for="type_contrat" class="block text-sm font-bold text-gray-700 mb-2">Contract Type</label>
                                <select id="type_contrat" name="type_contrat" required
                                    class="w-full bg-gray-50 border {{ $errors->has('type_contrat') ? 'border-red-400' : 'border-gray-200' }} text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                                    <option value="" disabled {{ old('type_contrat') ? '' : 'selected' }}>Select contract type</option>
                                    <option value="cdd" {{ old('type_contrat') == 'cdd' ? 'selected' : '' }}>CDD (Fixed-term)</option>
                                    <option value="cdi" {{ old('type_contrat') == 'cdi' ? 'selected' : '' }}>CDI (Permanent)</option>
                                    <option value="contract" {{ old('type_contrat') == 'contract' ? 'selected' : '' }}>Independent / Contract</option>
                                    <option value="freelance" {{ old('type_contrat') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                </select>
                                @error('type_contrat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Publication Date -->
                            <div>
                                <label for="date_publication" class="block text-sm font-bold text-gray-700 mb-2">Publication Date</label>
                                <input type="date" id="date_publication" name="date_publication" value="{{ old('date_publication') }}" required
                                    class="w-full bg-gray-50 border {{ $errors->has('date_publication') ? 'border-red-400' : 'border-gray-200' }} text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                                @error('date_publication') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="pt-4">
                            <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Job Description & Requirements</label>
                            <textarea id="description" name="description" rows="6" required placeholder="Detailed job description..."
                                class="w-full bg-gray-50 border {{ $errors->has('description') ? 'border-red-400' : 'border-gray-200' }} text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">{{ old('description') }}</textarea>
                            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="pt-6 border-t border-gray-100 flex justify-end">
                            <button type="submit" class="bg-[#a31b1b] hover:bg-[#8a1717] text-white px-8 py-3.5 rounded-xl font-bold text-lg transition-all duration-300 shadow-sm hover:shadow-md flex items-center gap-2">
                                <i class="bi bi-send-check"></i>
                                Publish Job
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</x-apps.app-employer>


