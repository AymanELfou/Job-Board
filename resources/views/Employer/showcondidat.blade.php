<x-apps.app-employer>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center py-1 px-4 gap-2">
            <div class="ml-2">
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    Candidate <span class="text-[#a31b1b]">Profile</span>
                </h2>
                <p class="text-gray-400 text-sm font-medium">Review and evaluate applicant details</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('employer.candidates') }}" class="inline-flex items-center gap-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-sm">
                    <i class="bi bi-arrow-left text-lg"></i>
                    Back to Candidates
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50/50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6">
                @include('incs.alert')
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row">
                
                <!-- Left Sidebar / Profile Picture -->
                <div class="md:w-1/3 bg-gray-50/50 border-b md:border-b-0 md:border-r border-gray-100 p-8 flex flex-col items-center justify-start">
                    <div class="w-48 h-48 rounded-full overflow-hidden bg-white border-4 border-white shadow-md mb-6 relative group">
                        <img src="{{ asset('imgs/job-seeker.png') }}" alt="Candidate" class="w-full h-full object-cover">
                        <div class="absolute inset-0 border-4 border-gray-100 rounded-full pointer-events-none"></div>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-gray-900 text-center mb-1">{{ $application->profilJobseeker->fullName ?? 'N/A' }}</h3>
                    <p class="text-gray-500 font-medium text-center mb-6">Candidate</p>
                    
                    <div class="w-full space-y-4">
                        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Status</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold border
                                {{ $application->status == 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : '' }}
                                {{ $application->status == 'approved' ? 'bg-green-50 text-green-700 border-green-200' : '' }}
                                {{ $application->status == 'rejected' ? 'bg-red-50 text-red-700 border-red-200' : '' }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </div>
                        
                        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Applied For</p>
                            <div class="flex items-center gap-2">
                                <i class="bi bi-briefcase-fill text-[#a31b1b]/70"></i>
                                <span class="font-bold text-gray-800">{{ $application->job->titre }}</span>
                            </div>
                        </div>

                        @if ($application->resume)
                        <a href="{{ asset('storage/' . $application->resume) }}" target="_blank" class="w-full bg-[#a31b1b]/10 hover:bg-[#a31b1b]/20 text-[#a31b1b] border border-[#a31b1b]/20 px-4 py-3 rounded-xl font-bold transition-all duration-300 shadow-sm flex items-center justify-center gap-2">
                            <i class="bi bi-file-earmark-arrow-down-fill"></i>
                            Download Resume
                        </a>
                        @else
                        <div class="w-full bg-gray-50 text-gray-400 border border-gray-200 px-4 py-3 rounded-xl font-medium flex items-center justify-center gap-2">
                            <i class="bi bi-file-earmark-x"></i>
                            No Resume
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Right Content Area -->
                <div class="md:w-2/3 p-8 md:p-10 space-y-10">
                    
                    <!-- Personal Information block -->
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-[#a31b1b]/10 text-[#a31b1b] flex items-center justify-center">
                                <i class="bi bi-person-lines-fill text-lg"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900">Personal Details</h4>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50/50 rounded-2xl p-6 border border-gray-100 align-top">
                            <div>
                                <p class="text-sm font-bold text-gray-400 uppercase tracking-wide mb-1">Contact Email</p>
                                @if($application->profilJobseeker && $application->profilJobseeker->contact_information)
                                    <a href="mailto:{{ $application->profilJobseeker->contact_information }}" class="font-bold text-[#a31b1b] hover:underline">{{ $application->profilJobseeker->contact_information }}</a>
                                @else
                                    <p class="font-bold text-gray-900">N/A</p>
                                @endif
                            </div>
                            <!-- Future fields can go here depending on what is available -->
                        </div>
                    </div>

                    <!-- Qualifications Block -->
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                <i class="bi bi-mortarboard-fill text-lg"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900">Qualifications</h4>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="bg-gray-50/50 rounded-2xl p-6 border border-gray-100">
                                <p class="text-sm font-bold text-gray-400 uppercase tracking-wide mb-2">Education</p>
                                <p class="text-gray-800 font-medium leading-relaxed">{{ $application->profilJobseeker->education ?? 'No education information provided.' }}</p>
                            </div>
                            
                            <div class="bg-gray-50/50 rounded-2xl p-6 border border-gray-100">
                                <p class="text-sm font-bold text-gray-400 uppercase tracking-wide mb-2">Experience</p>
                                <p class="text-gray-800 font-medium leading-relaxed">{{ $application->profilJobseeker->experience ?? 'No experience information provided.' }}</p>
                            </div>

                            <div class="bg-gray-50/50 rounded-2xl p-6 border border-gray-100">
                                <p class="text-sm font-bold text-gray-400 uppercase tracking-wide mb-2">Competences</p>
                                <p class="text-gray-800 font-medium leading-relaxed">{{ $application->profilJobseeker->competences ?? 'No competences listed.' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Application specifics -->
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                                <i class="bi bi-file-text-fill text-lg"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900">Application Letter</h4>
                        </div>
                        <div class="bg-gray-50/50 rounded-2xl p-6 border border-gray-100">
                            @if($application->cover_letter)
                                <p class="text-gray-700 leading-relaxed whitespace-pre-wrap font-medium">{{ $application->cover_letter }}</p>
                            @else
                                <p class="text-gray-400 italic font-medium">No cover letter provided.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Action: Update Status -->
                    <div class="border-t border-gray-100 pt-8 mt-8">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center">
                                <i class="bi bi-arrow-repeat text-lg"></i>
                            </div>
                            <h5 class="text-lg font-bold text-gray-900">Update Application Status</h5>
                        </div>
                        
                        <form action="{{ route('applications.updateStatus', $application->id) }}" method="POST" class="bg-gray-50 rounded-xl p-6 border border-gray-100 flex flex-col sm:flex-row items-end gap-4">
                            @csrf
                            @method('PUT')
                            <div class="flex-grow w-full">
                                <label for="status" class="block text-sm font-bold text-gray-700 mb-2">Change Status:</label>
                                <select name="status" id="status" class="w-full bg-white border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-3 transition-colors duration-200 font-bold">
                                    <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>
                            <button type="submit" class="w-full sm:w-auto bg-[#a31b1b] hover:bg-[#8a1717] text-white px-8 py-3 rounded-xl font-bold transition-all duration-300 shadow-sm hover:shadow-md whitespace-nowrap">
                                Update Status
                            </button>
                        </form>
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</x-apps.app-employer>