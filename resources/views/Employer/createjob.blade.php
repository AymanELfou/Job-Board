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
                <a href="{{ route('employer.jobs.index') }}" class="inline-flex items-center gap-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-sm">
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
                    <form action="{{ route('employer.jobs.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <input type="hidden" name="id_employeur" value="{{ auth()->user()->id }}"/>
                
                        <!-- Grid 2 cols for shorter inputs -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Job Title -->
                            <div class="col-span-1 md:col-span-2">
                                <label for="titre" class="block text-sm font-bold text-gray-700 mb-2">Job Title</label>
                                <input type="text" id="titre" name="titre" required
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                            </div>

                            <!-- Location -->
                            <div>
                                <label for="location" class="block text-sm font-bold text-gray-700 mb-2">Location</label>
                                <input type="text" id="location" name="location" required
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                            </div>

                            <!-- Salary -->
                            <div>
                                <label for="salaire" class="block text-sm font-bold text-gray-700 mb-2">Salary Estimate</label>
                                <input type="text" id="salaire" name="salaire" required placeholder="e.g. $50,000 - $70,000/year"
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                            </div>

                            <!-- Job Type -->
                            <div>
                                <label for="type" class="block text-sm font-bold text-gray-700 mb-2">Employment Type</label>
                                <select id="type" name="job_type" required
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                                    <option value="" disabled selected>Select employment type</option>
                                    <option value="Full Time">Full Time</option>
                                    <option value="Part Time">Part Time</option>
                                    <option value="Internship">Internship</option>
                                </select>
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category" class="block text-sm font-bold text-gray-700 mb-2">Category</label>
                                <select id="category" name="categorie" required
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                                    <option value="" disabled selected>Select category</option>
                                    <option value="tech">Technology</option>
                                    <option value="sells">Sales</option>
                                    <option value="marketing">Marketing</option>
                                    <option value="finance">Finance</option>
                                    <option value="education">Education</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <!-- Contract Type -->
                            <div>
                                <label for="type_contrat" class="block text-sm font-bold text-gray-700 mb-2">Contract Type</label>
                                <select id="type_contrat" name="type_contrat" required
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                                    <option value="" disabled selected>Select contract type</option>
                                    <option value="cdd">CDD (Fixed-term)</option>
                                    <option value="cdi">CDI (Permanent)</option>
                                    <option value="contract">Independent / Contract</option>
                                    <option value="freelance">Freelance</option>
                                </select>
                            </div>

                            <!-- Publication Date -->
                            <div>
                                <label for="date_publication" class="block text-sm font-bold text-gray-700 mb-2">Publication Date</label>
                                <input type="date" id="date_publication" name="date_publication" required
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="pt-4">
                            <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Job Description & Requirements</label>
                            <textarea id="description" name="description" rows="6" required placeholder="Detailed job description..."
                                class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200"></textarea>
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


