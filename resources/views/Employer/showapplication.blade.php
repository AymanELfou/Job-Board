<x-apps.app-employer>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center py-1 px-4 gap-2">
            <div class="ml-2">
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    Application <span class="text-[#a31b1b]">Details</span>
                </h2>
                <p class="text-gray-400 text-sm font-medium">Review candidate application information</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('employer.applications.index') }}" class="inline-flex items-center gap-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-sm">
                    <i class="bi bi-arrow-left text-lg"></i>
                    Back to Applications
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50/50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6">
                @include('incs.alert')
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <!-- Header part -->
                <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Application Overview</h3>
                    
                    <span class="px-3 py-1 rounded-full text-sm font-bold border
                        {{ $application->status == 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : '' }}
                        {{ $application->status == 'approved' ? 'bg-green-50 text-green-700 border-green-200' : '' }}
                        {{ $application->status == 'rejected' ? 'bg-red-50 text-red-700 border-red-200' : '' }}">
                        {{ ucfirst($application->status) }}
                    </span>
                </div>
                
                <div class="p-8 md:p-10 space-y-10">
                    
                    <!-- Job Information -->
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center">
                                <i class="bi bi-briefcase-fill text-lg"></i>
                            </div>
                            <h5 class="text-lg font-bold text-gray-900">Job Information</h5>
                        </div>
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="md:col-span-2">
                                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wide mb-1">Title</p>
                                    <p class="font-bold text-gray-900">{{ $application->job->titre }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wide mb-1">Posted by</p>
                                    <p class="font-bold text-gray-900">{{ $application->job->company }}</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-400 uppercase tracking-wide mb-1">Description</p>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ $application->job->description }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Applicant Information -->
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-[#a31b1b]/10 text-[#a31b1b] flex items-center justify-center">
                                <i class="bi bi-person-badge-fill text-lg"></i>
                            </div>
                            <h5 class="text-lg font-bold text-gray-900">Applicant Information</h5>
                        </div>
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wide mb-1">Name</p>
                                    <p class="font-bold text-gray-900">{{ $application->profilJobseeker->fullName ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wide mb-1">Contact Email</p>
                                    @if($application->profilJobseeker && $application->profilJobseeker->contact_information)
                                    <a href="mailto:{{ $application->profilJobseeker->contact_information }}" class="font-bold text-[#a31b1b] hover:underline">{{ $application->profilJobseeker->contact_information }}</a>
                                    @else
                                    <p class="font-bold text-gray-900">N/A</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action: Update Status -->
                    <div class="border-t border-gray-100 pt-8">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center">
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
