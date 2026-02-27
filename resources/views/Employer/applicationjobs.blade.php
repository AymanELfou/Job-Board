<x-apps.app-employer>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center py-1 px-4 gap-2">
            <div class="ml-2">
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    My <span class="text-[#a31b1b]">Applications</span>
                </h2>
                <p class="text-gray-400 text-sm font-medium">Review and manage candidate applications</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6">
                @include('incs.alert')
            </div>

            @if($applications->isEmpty())
                <div class="bg-blue-50/50 border border-blue-100 rounded-[2rem] p-10 text-center">
                    <div class="w-20 h-20 mx-auto bg-blue-100 rounded-full flex items-center justify-center text-blue-500 text-4xl mb-4">
                        <i class="bi bi-inbox"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No Applications Yet</h3>
                    <p class="text-gray-500">No candidates have applied for your jobs at this moment.</p>
                </div>
            @else
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800">Recent Applications ({{ $applications->count() }})</h3>
                    </div>
                    
                    <div class="divide-y divide-gray-100">
                        @foreach($applications as $application)
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-200 group">
                            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                                
                                <!-- Candidate Info & Job Title -->
                                <div class="flex items-center gap-6 flex-grow">
                                    <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center text-gray-400 text-2xl flex-shrink-0">
                                        <i class="bi bi-person-badge"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-bold text-gray-900 mb-1">{{ $application->profilJobseeker->fullName ?? "Applicant's name" }}</h4>
                                        <div class="flex items-center gap-2 text-sm text-gray-500 font-medium">
                                            <i class="bi bi-briefcase-fill text-[#a31b1b]/70"></i>
                                            Applied for: <span class="text-gray-700 font-bold bg-white px-2 py-0.5 border border-gray-200 rounded-md">{{ $application->job->titre ?? 'Job Title' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Control -->
                                <div class="flex items-center gap-4 lg:min-w-[250px] justify-start lg:justify-end">
                                    <form action="{{ route('applications.updateStatus', $application->id) }}" method="POST" class="m-0 flex-grow lg:flex-grow-0">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" id="status-{{ $application->id }}" class="w-full lg:w-40 bg-white border border-gray-200 text-sm font-bold text-gray-700 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] py-2.5 transition-colors duration-200" onchange="this.form.submit()">
                                            <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </form>
                                    
                                    <!-- Badges logic based on status if we wanted to show instead of select -->
                                    <div class="w-3 h-3 rounded-full flex-shrink-0
                                        {{ $application->status == 'approved' ? 'bg-green-500' : '' }}
                                        {{ $application->status == 'rejected' ? 'bg-red-500' : '' }}
                                        {{ $application->status == 'pending' ? 'bg-yellow-400' : '' }}
                                    "></div>
                                </div>

                                <!-- Actions -->
                                <div class="flex items-center justify-end gap-3 flex-shrink-0 pt-4 lg:pt-0 border-t lg:border-t-0 border-gray-100 mt-4 lg:mt-0 lg:pl-6 lg:border-l">
                                    <a href="{{ route('employer.applications.show', $application->id) }}" class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-300" title="View Application Details">
                                        <i class="bi bi-eye-fill text-lg"></i>
                                    </a>
                                    
                                    <form action="{{ route('employer.applications.destroy', $application->id) }}" method="post" class="m-0">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this application?')" class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all duration-300" title="Delete Application">
                                            <i class="bi bi-trash3-fill text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-apps.app-employer>
