<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center w-full">
            <div>
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight m-0">
                    Application <span class="text-[#a31b1b]">Details</span>
                </h2>
                <p class="text-gray-500 text-sm font-medium mt-1 mb-0">Comprehensive review of the candidate's submission</p>
            </div>
            
            <div class="mt-3 md:mt-0">
                <a href="{{ route('applications.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 rounded-xl font-bold text-gray-700 hover:bg-gray-50 transition-all shadow-sm no-underline text-decoration-none" style="text-decoration: none;">
                    <i class="bi bi-arrow-left me-2"></i> Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Main Content Column (Job & Applicant Info) -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Job Information Card -->
                    <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 relative overflow-hidden">
                        <!-- Decorative top accent -->
                        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#a31b1b] to-red-600"></div>
                        
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-xl bg-[#a31b1b]/10 flex items-center justify-center text-[#a31b1b] text-xl">
                                <i class="bi bi-briefcase-fill"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Job Information</h3>
                        </div>

                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <span class="block text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Job Title</span>
                                    <p class="text-lg font-bold text-gray-800">{{ $application->job->titre ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <span class="block text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Company</span>
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-building text-gray-400"></i>
                                        <p class="text-lg font-bold text-gray-800">{{ $application->job->profilEmployer->nom_entreprise ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <span class="block text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Location</span>
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-geo-alt-fill text-[#a31b1b]"></i>
                                    <p class="text-md font-medium text-gray-700">{{ $application->job->location ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-gray-100">
                                <span class="block text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Job Description</span>
                                <div class="prose prose-sm text-gray-600 max-w-none">
                                    {{ $application->job->description ?? 'No description provided.' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Applicant Information Card -->
                    <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 relative overflow-hidden">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 text-xl">
                                <i class="bi bi-person-vcard-fill"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Applicant Profile</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            <!-- Personal Details -->
                            <div class="space-y-6">
                                <div>
                                    <span class="block text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Full Name</span>
                                    <p class="text-xl font-bold text-gray-900">{{ $application->profilJobseeker->fullName ?? 'N/A' }}</p>
                                </div>
                                
                                <div>
                                    <span class="block text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Contact Information</span>
                                    <div class="flex items-center gap-2 text-gray-700 font-medium bg-gray-50 px-4 py-2 rounded-xl border border-gray-100 inline-block">
                                        <i class="bi bi-telephone-fill text-gray-400"></i>
                                        {{ $application->profilJobseeker->contact_information ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Professional Details -->
                            <div class="space-y-6">
                                <div>
                                    <span class="block text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Core Skills</span>
                                    <div class="flex flex-wrap gap-2">
                                        @if(isset($application->profilJobseeker->competences))
                                            @foreach(explode(',', $application->profilJobseeker->competences) as $skill)
                                                <span class="px-3 py-1 bg-gray-50 text-gray-700 border border-gray-200 rounded-lg text-sm font-medium">
                                                    {{ trim($skill) }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-gray-500 italic">N/A</span>
                                        @endif
                                    </div>
                                </div>

                                <div>
                                    <span class="block text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Education</span>
                                    <div class="flex items-start gap-3">
                                        <div class="mt-1 flex-shrink-0 w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                                            <i class="bi bi-mortarboard-fill"></i>
                                        </div>
                                        <p class="text-md font-medium text-gray-800">{{ $application->profilJobseeker->education ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Full Width Experience -->
                            <div class="md:col-span-2 pt-4 border-t border-gray-100">
                                <span class="block text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Professional Experience</span>
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 text-gray-700">
                                    {{ $application->profilJobseeker->experience ?? 'No experience details provided.' }}
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>

                <!-- Sidebar Column (Status & Actions) -->
                <div class="space-y-8">
                    
                    <!-- Application Status Card -->
                    <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 text-center">
                        <h3 class="text-lg font-bold text-gray-800 mb-6">Current Status</h3>
                        
                        @php
                            $status = strtolower($application->status ?? 'pending');
                            $bgColor = 'bg-yellow-50';
                            $textColor = 'text-yellow-700';
                            $borderColor = 'border-yellow-200';
                            $icon = 'bi-hourglass-split';
                            
                            if ($status === 'approved') {
                                $bgColor = 'bg-green-50';
                                $textColor = 'text-green-700';
                                $borderColor = 'border-green-200';
                                $icon = 'bi-check-circle-fill';
                            } elseif ($status === 'rejected') {
                                $bgColor = 'bg-red-50';
                                $textColor = 'text-red-700';
                                $borderColor = 'border-red-200';
                                $icon = 'bi-x-circle-fill';
                            }
                        @endphp

                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full {{ $bgColor }} mb-4 border-4 border-white shadow-sm">
                            <i class="bi {{ $icon }} text-4xl {{ $textColor }}"></i>
                        </div>
                        
                        <div class="px-6 py-2 rounded-full border {{ $borderColor }} {{ $bgColor }} {{ $textColor }} inline-block font-extrabold uppercase tracking-widest text-sm mb-6">
                            {{ ucfirst($status) }}
                        </div>

                        <!-- Status Update Form -->
                        <div class="pt-6 border-t border-gray-100 text-left">
                            <label class="block text-sm font-bold text-gray-500 mb-2">Update Status</label>
                            <form action="{{ route('updateStatus', $application->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="flex gap-2">
                                    <select name="status" class="flex-1 bg-gray-50 border border-gray-200 text-gray-700 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] font-medium">
                                        <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $status == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ $status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-xl font-bold hover:bg-gray-900 transition-colors">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Action Card -->
                    <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100">
                        <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4 px-2">Actions</h4>
                        <div class="space-y-3">
                            {{--  
                            <button class="w-full flex items-center justify-between px-4 py-3 bg-blue-50 text-blue-700 rounded-xl font-bold hover:bg-blue-100 transition-colors border border-blue-100 group">
                                <span>Download Resume</span>
                                <i class="bi bi-download text-xl group-hover:scale-110 transition-transform"></i>
                            </button>
                            --}}
                            
                            <form action="{{ route('applications.destroy', $application->id) }}" method="post" class="w-full m-0">
                                @csrf
                                @method('delete')
                                <button type="submit" class="w-full flex items-center justify-between px-4 py-3 bg-red-50 text-[#a31b1b] rounded-xl font-bold hover:bg-[#a31b1b] hover:text-white transition-colors border border-red-100 group no-underline text-decoration-none" style="text-decoration: none;" onclick="return confirm('Are you sure you want to delete this application record entirely?')">
                                    <span>Terminate</span>
                                    <i class="bi bi-trash-fill text-xl group-hover:scale-110 transition-transform"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    
    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        a { text-decoration: none !important; }
    </style>
    @endpush
</x-app-layout>