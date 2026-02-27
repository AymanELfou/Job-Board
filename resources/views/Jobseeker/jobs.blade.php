<x-apps.app-jobseeker>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center py-1 px-4 gap-2">
            <div class="ml-2">
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    Find <span class="text-[#a31b1b]">Jobs</span>
                </h2>
                <p class="text-gray-400 text-sm font-medium">Discover your next career opportunity</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @include('incs.alert')

            <!-- Search Section -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-6 md:p-8">
                <form action="{{ route('jobseeker.jobs.search') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="bi bi-tag text-gray-400 text-lg"></i>
                        </div>
                        <input type="search" name="categorie" placeholder="Search by Category (e.g., Tech, Design)" 
                               class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] transition-colors font-medium">
                    </div>
                    
                    <div class="flex-grow relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="bi bi-geo-alt text-gray-400 text-lg"></i>
                        </div>
                        <input type="search" name="location" placeholder="Search by Location" 
                               class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] transition-colors font-medium">
                    </div>
                    
                    <button type="submit" class="bg-[#a31b1b] hover:bg-[#8a1717] text-white px-8 py-3.5 rounded-xl font-bold transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 md:w-auto w-full">
                        <i class="bi bi-search"></i>
                        Search Jobs
                    </button>
                </form>
            </div>

            @if($jobs->isEmpty())
                <div class="bg-white border border-red-100 bg-red-50/30 rounded-2xl p-8 text-center">
                    <div class="text-red-500 mb-4">
                        <i class="bi bi-search text-5xl opacity-50"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No jobs found</h3>
                    <p class="text-gray-500">Try adjusting your search filters to find more opportunities.</p>
                </div>
            @else
                
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($jobs as $job)
                        <div x-data="{ applyModalOpen: false }" class="group bg-white border border-gray-100 rounded-[1.5rem] p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 hover:border-[#a31b1b]/30 flex flex-col h-full relative">
                            
                            <!-- Badges -->
                            <div class="flex justify-between items-start mb-4">
                                <span class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-xl text-xs font-bold uppercase tracking-wider border border-blue-100/50 shadow-sm flex items-center gap-1.5">
                                    <i class="bi bi-briefcase"></i> {{ $job['job_type'] }}
                                </span>
                                
                                <form action="{{ route('jobs.save', $job->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-xl transition-transform hover:scale-110 {{ $job->isSavedBy(auth()->user()->profile) ? 'text-[#a31b1b]' : 'text-gray-300 hover:text-gray-500' }}" title="{{ $job->isSavedBy(auth()->user()->profile) ? 'Unsave' : 'Save' }}">
                                        <i class="bi {{ $job->isSavedBy(auth()->user()->profile) ? 'bi-bookmark-fill' : 'bi-bookmark' }}"></i>
                                    </button>
                                </form>
                            </div>
                            
                            <!-- Content -->
                            <h4 class="text-xl font-bold text-gray-900 mb-3 leading-snug line-clamp-2">{{ $job['titre'] }}</h4>
                            
                            <div class="space-y-2 mb-4">
                                <p class="text-gray-600 text-sm font-medium flex items-start gap-2">
                                    <i class="bi bi-building text-gray-400 mt-0.5"></i>
                                    {{ $job->profilEmployer->nom_entreprise }} <span class="text-gray-300">•</span> {{ $job['categorie'] }}
                                </p>
                                <p class="text-gray-600 text-sm font-medium flex items-center gap-2">
                                    <i class="bi bi-geo-alt text-gray-400"></i>
                                    {{ $job['location'] }}
                                </p>
                                <p class="text-gray-600 text-sm font-medium flex items-center gap-2">
                                    <i class="bi bi-currency-dollar text-gray-400"></i>
                                    {{ $job['salaire'] }} <span class="text-gray-300">•</span> {{ $job['type_contrat'] }}
                                </p>
                            </div>
                            
                            <p class="text-gray-500 text-sm mb-6 line-clamp-3 leading-relaxed flex-grow">
                                {{ \Illuminate\Support\Str::limit($job['description'], 150, '...') }}
                            </p>
                            
                            <!-- Apply Button -->
                            <div class="mt-auto pt-4 border-t border-gray-100">
                                @if (!$job->applications->where('id_jobseeker', auth()->user()->profile->id)->isEmpty())
                                    <button disabled class="w-full bg-gray-100 text-gray-400 font-bold py-3 rounded-xl flex items-center justify-center gap-2 cursor-not-allowed">
                                        <i class="bi bi-check-circle-fill"></i> Already Applied
                                    </button>
                                @else
                                    <button @click="applyModalOpen = true" class="w-full bg-[#a31b1b] hover:bg-[#8a1717] text-white font-bold py-3 rounded-xl transition-all shadow-sm hover:shadow flex items-center justify-center gap-2">
                                        <i class="bi bi-send"></i> Apply Now
                                    </button>
                                @endif
                            </div>

                            <!-- Application Modal (Alpine.js) -->
                            <div x-show="applyModalOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    
                                    <div x-show="applyModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900 bg-opacity-75 backdrop-blur-sm transition-opacity" @click="applyModalOpen = false"></div>

                                    <!-- This element is to trick the browser into centering the modal contents. -->
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                                    <div x-show="applyModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-[2rem] text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                                        
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-gray-100">
                                            <div class="flex justify-between items-center mb-5">
                                                <h3 class="text-2xl font-bold text-gray-900" id="modal-title">
                                                    Apply for <span class="text-[#a31b1b]">{{ $job['titre'] }}</span>
                                                </h3>
                                                <button @click="applyModalOpen = false" class="text-gray-400 hover:text-gray-600 transition-colors w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                            </div>
                                            
                                            <form action="{{ route('jobs.apply', $job->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                                                @csrf
                                                <div>
                                                    <label for="resume_{{ $job->id }}" class="block text-sm font-bold text-gray-700 mb-2">Upload Resume (PDF, DOCX)</label>
                                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-[#a31b1b] transition-colors bg-gray-50">
                                                        <div class="space-y-1 text-center">
                                                            <i class="bi bi-cloud-arrow-up text-4xl text-gray-400"></i>
                                                            <div class="flex text-sm text-gray-600 justify-center">
                                                                <label for="resume_{{ $job->id }}" class="relative cursor-pointer bg-white rounded-md font-medium text-[#a31b1b] hover:text-[#8a1717] focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#a31b1b] px-1">
                                                                    <span>Upload a file</span>
                                                                    <input id="resume_{{ $job->id }}" name="resume" type="file" class="sr-only" required>
                                                                </label>
                                                            </div>
                                                            <p class="text-xs text-gray-500">Max size 5MB</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div>
                                                    <label for="cover_letter_{{ $job->id }}" class="block text-sm font-bold text-gray-700 mb-2">Cover Letter</label>
                                                    <textarea id="cover_letter_{{ $job->id }}" name="cover_letter" rows="5" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200" placeholder="Introduce yourself and explain why you're a great fit for this role..." required></textarea>
                                                </div>

                                                <div class="pt-4 flex justify-end gap-3">
                                                    <button type="button" @click="applyModalOpen = false" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold py-2.5 px-6 rounded-xl transition-colors">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" class="bg-[#a31b1b] hover:bg-[#8a1717] text-white font-bold py-2.5 px-6 rounded-xl transition-all shadow-sm hover:shadow flex items-center justify-center gap-2">
                                                        <i class="bi bi-send-check"></i> Submit Application
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->

                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-8">
                {{ $jobs->links() }}
            </div>
            
        </div>
    </div>
</x-apps.app-jobseeker>