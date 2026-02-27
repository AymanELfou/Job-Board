<x-apps.app-employer>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center py-1 px-4 gap-2">
            <div class="ml-2">
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    Edit <span class="text-[#a31b1b]">Job Post</span>
                </h2>
                <p class="text-gray-400 text-sm font-medium">Update existing job details</p>
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
                    <form action="{{ route('employer.jobs.update', $job->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method("PUT")
                
                        <!-- Grid 2 cols for shorter inputs -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Job Title -->
                            <div class="col-span-1 md:col-span-2">
                                <label for="titre" class="block text-sm font-bold text-gray-700 mb-2">Job Title</label>
                                <input type="text" id="titre" name="titre" value="{{ $job->titre }}" required
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                            </div>

                            <!-- Location -->
                            <div>
                                <label for="location" class="block text-sm font-bold text-gray-700 mb-2">Location</label>
                                <input type="text" id="location" name="location" value="{{ $job->location }}" required
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                            </div>

                            <!-- Salary -->
                            <div>
                                <label for="salaire" class="block text-sm font-bold text-gray-700 mb-2">Salary Estimate</label>
                                <input type="text" id="salaire" name="salaire" value="{{ $job->salaire }}" required
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                            </div>

                            <!-- Job Type -->
                            <div>
                                <label for="type" class="block text-sm font-bold text-gray-700 mb-2">Employment Type</label>
                                <select id="type" name="job_type" required
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                                    <option value="full_time" <?php echo ($job->job_type == 'full_time' || $job->job_type == 'Full Time') ? 'selected' : ''; ?>>Full Time</option>
                                    <option value="part_time" <?php echo ($job->job_type == 'part_time' || $job->job_type == 'Part Time') ? 'selected' : ''; ?>>Part Time</option>
                                    <option value="Internship" <?php echo ($job->job_type == 'Internship') ? 'selected' : ''; ?>>Internship</option>
                                </select>
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category" class="block text-sm font-bold text-gray-700 mb-2">Category</label>
                                <select id="category" name="categorie" required
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                                    <option value="tech" <?php echo ($job->categorie == 'tech') ? 'selected' : ''; ?>>Technology</option>
                                    <option value="sells" <?php echo ($job->categorie == 'sells') ? 'selected' : ''; ?>>Sales</option>
                                    <option value="marketing" <?php echo ($job->categorie == 'marketing') ? 'selected' : ''; ?>>Marketing</option>
                                    <option value="finance" <?php echo ($job->categorie == 'finance') ? 'selected' : ''; ?>>Finance</option>
                                    <option value="education" <?php echo ($job->categorie == 'education') ? 'selected' : ''; ?>>Education</option>
                                    <option value="other" <?php echo ($job->categorie == 'other') ? 'selected' : ''; ?>>Other</option>
                                </select>
                            </div>

                            <!-- Contract Type -->
                            <div>
                                <label for="type_contrat" class="block text-sm font-bold text-gray-700 mb-2">Contract Type</label>
                                <select id="type_contrat" name="type_contrat" required
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                                    <option value="cdd" <?php echo ($job->type_contrat == 'cdd') ? 'selected' : ''; ?>>CDD (Fixed-term)</option>
                                    <option value="cdi" <?php echo ($job->type_contrat == 'cdi') ? 'selected' : ''; ?>>CDI (Permanent)</option>
                                </select>
                            </div>

                            <!-- Publication Date -->
                            <div>
                                <label for="date_publication" class="block text-sm font-bold text-gray-700 mb-2">Publication Date</label>
                                <input type="date" id="date_publication" name="date_publication" value="{{ $job->date_publication }}" required
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="pt-4">
                            <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Job Description & Requirements</label>
                            <textarea id="description" name="description" rows="6" required
                                class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200">{{ $job->description }}</textarea>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="pt-6 border-t border-gray-100 flex justify-end">
                            <button type="submit" class="bg-[#a31b1b] hover:bg-[#8a1717] text-white px-8 py-3.5 rounded-xl font-bold text-lg transition-all duration-300 shadow-sm hover:shadow-md flex items-center gap-2">
                                <i class="bi bi-save"></i>
                                Save Changes
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</x-apps.app-employer>


