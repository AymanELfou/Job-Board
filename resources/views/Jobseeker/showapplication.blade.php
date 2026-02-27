<x-apps.app-jobseeker>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center py-1 px-4 gap-2">
            <div class="ml-2">
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    Application <span class="text-[#a31b1b]">Details</span>
                </h2>
                <p class="text-gray-400 text-sm font-medium">Review the details of your job application</p>
            </div>
            
            <div class="mt-4 md:mt-0">
                <a href="{{ route('jobseeker.applications.index') }}" class="inline-flex items-center gap-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-sm">
                    <i class="bi bi-arrow-left text-lg"></i>
                    Back to Applications
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50/50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                <!-- Header Section -->
                <div class="bg-gradient-to-r from-gray-50 to-white pt-10 pb-8 px-8 md:px-12 border-b border-gray-100 relative">
                    
                    @php
                        $statusClass = 'bg-yellow-50 text-yellow-700 border-yellow-200';
                        $statusIcon = 'bi-hourglass-split';
                        
                        $status = strtolower($application->status ?? 'pending');
                        if (in_array($status, ['accepted', 'approved', 'hired'])) {
                            $statusClass = 'bg-green-50 text-green-700 border-green-200';
                            $statusIcon = 'bi-check-circle-fill';
                        } elseif (in_array($status, ['rejected', 'declined'])) {
                            $statusClass = 'bg-red-50 text-red-700 border-red-200';
                            $statusIcon = 'bi-x-circle-fill';
                        } elseif (in_array($status, ['reviewed', 'viewed'])) {
                            $statusClass = 'bg-blue-50 text-blue-700 border-blue-200';
                            $statusIcon = 'bi-eye-fill';
                        }
                    @endphp

                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                        <div class="flex items-center gap-6">
                            <div class="w-20 h-20 bg-gray-50 border border-gray-100 rounded-[1.25rem] shadow-sm flex items-center justify-center shrink-0">
                                <i class="bi bi-briefcase-fill text-4xl text-gray-300"></i>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 leading-tight mb-2">{{ $application->job->titre }}</h1>
                                <p class="text-gray-500 font-medium text-lg flex items-center gap-2">
                                    <i class="bi bi-building"></i> {{ $application->job->company ?? $application->job->profilEmployer->nom_entreprise ?? 'Company Name' }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex flex-col items-start md:items-end gap-3 mt-4 md:mt-0">
                            <span class="px-5 py-2.5 rounded-full text-sm font-bold tracking-widest uppercase border flex items-center gap-2 shadow-sm {{ $statusClass }}">
                                <i class="bi {{ $statusIcon }}"></i>
                                {{ $application->status }}
                            </span>
                            <span class="text-xs text-gray-400 font-bold uppercase tracking-wider flex items-center gap-1.5">
                                <i class="bi bi-calendar3"></i> Applied on {{ $application->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Body Section -->
                <div class="p-8 md:p-12">
                    
                    <!-- Job Details Grid -->
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i class="bi bi-info-square text-[#a31b1b]"></i> Job Overview
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 bg-gray-50/50 rounded-2xl p-6 border border-gray-100 mb-10">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center shrink-0 text-gray-400">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">Location</p>
                                <p class="font-semibold text-gray-900">{{ $application->job->location }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center shrink-0 text-gray-400">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">Salary</p>
                                <p class="font-semibold text-gray-900">{{ $application->job->salaire ?? 'Not specified' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center shrink-0 text-gray-400">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">Job Type</p>
                                <p class="font-semibold text-gray-900">{{ $application->job->job_type }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center shrink-0 text-gray-400">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">Contract</p>
                                <p class="font-semibold text-gray-900">{{ $application->job->type_contrat }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Job Description -->
                    <div class="mb-10">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <i class="bi bi-card-text text-[#a31b1b]"></i> Job Description
                        </h3>
                        
                        <div class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 prose prose-gray max-w-none text-gray-600 shadow-sm">
                            {!! nl2br(e($application->job->description)) !!}
                        </div>
                    </div>

                    <!-- Application Info -->
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <i class="bi bi-person-lines-fill text-[#a31b1b]"></i> My Submission
                        </h3>
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-bold text-gray-900 mb-1">Application Submitted</p>
                                <p class="text-sm text-gray-500">Your profile and resume were sent to the employer.</p>
                            </div>
                            <div class="text-right">
                                <span class="bg-white text-gray-600 px-4 py-2 rounded-xl text-sm font-bold border border-gray-200 shadow-sm flex items-center gap-2">
                                    <i class="bi bi-check2-circle text-green-500"></i> Submitted
                                </span>
                            </div>
                        </div>
                        
                        <!-- Actions -->
                        <div class="mt-8 flex justify-end">
                            <form action="{{ route('jobseeker.applications.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to withdraw this application? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-white border border-red-200 hover:bg-red-50 text-red-500 hover:text-red-700 font-bold py-3 px-6 rounded-xl transition-all shadow-sm flex items-center justify-center gap-2">
                                    <i class="bi bi-trash"></i> Withdraw Application
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-apps.app-jobseeker>