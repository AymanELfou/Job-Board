<x-apps.app-jobseeker>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center py-1 px-4 gap-2">
            <div class="ml-2">
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    My <span class="text-[#a31b1b]">Applications</span>
                </h2>
                <p class="text-gray-400 text-sm font-medium">Track the status of your recent job applications</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('jobseeker.jobs.index') }}" class="inline-flex items-center gap-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-sm">
                    <i class="bi bi-search text-lg"></i>
                    Find More Jobs
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @include('incs.alert')

            @if($applications->isEmpty())
                <div class="bg-white border border-gray-100 rounded-[2rem] p-12 text-center shadow-sm">
                    <div class="text-gray-300 mb-6 flex justify-center">
                        <i class="bi bi-journal-x text-6xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">No applications found</h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">You haven't applied to any jobs yet. Start exploring opportunities and apply to get noticed by top employers.</p>
                    <a href="{{ route('jobseeker.jobs.index') }}" class="inline-flex items-center gap-2 bg-[#a31b1b] hover:bg-[#8a1717] text-white px-8 py-3.5 rounded-xl font-bold transition-all shadow-sm">
                        <i class="bi bi-briefcase"></i>
                        Explore Jobs
                    </a>
                </div>
            @else
                
                <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                    <!-- List Header -->
                    <div class="hidden md:grid grid-cols-12 gap-4 px-8 py-5 border-b border-gray-100 bg-gray-50/50 text-xs font-bold text-gray-500 uppercase tracking-wider">
                        <div class="col-span-4">Job Info</div>
                        <div class="col-span-3">Company</div>
                        <div class="col-span-3">Status</div>
                        <div class="col-span-2 text-right">Actions</div>
                    </div>

                    <!-- List Body -->
                    <div class="divide-y divide-gray-100">
                        @foreach($applications as $application)
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 px-6 md:px-8 py-6 items-center hover:bg-gray-50/80 transition-colors duration-200 group">
                                
                                <!-- Job Info -->
                                <div class="col-span-1 md:col-span-4 flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gray-100 text-gray-500 rounded-xl flex shrink-0 items-center justify-center border border-gray-200 shadow-sm group-hover:bg-[#a31b1b] group-hover:text-white group-hover:border-[#a31b1b] transition-colors">
                                        <i class="bi bi-file-earmark-text text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-bold text-gray-900 leading-tight mb-1">{{ $application->job->titre ?? 'Job Title' }}</h4>
                                        <p class="text-gray-500 text-sm font-medium flex items-center gap-1.5">
                                            <i class="bi bi-clock"></i> Applied on {{ $application->created_at->format('M d, Y') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Company -->
                                <div class="col-span-1 md:col-span-3 flex items-center gap-2 border-t md:border-t-0 border-gray-100 pt-3 md:pt-0">
                                    <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider w-20">Company:</span>
                                    <div class="flex items-center gap-2 text-gray-700 font-semibold">
                                        <i class="bi bi-building text-gray-400"></i>
                                        {{ $application->job->profilEmployer->nom_entreprise ?? "Not specified" }}
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-span-1 md:col-span-3 flex items-center gap-2 border-t md:border-t-0 border-gray-100 pt-3 md:pt-0">
                                    <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider w-20">Status:</span>
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
                                    <span class="px-3 py-1 rounded-full text-xs font-bold tracking-wide uppercase border flex items-center gap-1.5 {{ $statusClass }}">
                                        <i class="bi {{ $statusIcon }}"></i>
                                        {{ $application->status ?? 'Pending' }}
                                    </span>
                                </div>

                                <!-- Actions -->
                                <div class="col-span-1 md:col-span-2 flex items-center md:justify-end gap-2 border-t md:border-t-0 border-gray-100 pt-4 md:pt-0">
                                    <a href="{{ route('jobseeker.applications.show', $application->id) }}" class="flex-1 md:flex-none text-center bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold p-2.5 rounded-xl transition-colors shadow-sm" title="View Details">
                                        <i class="bi bi-eye text-lg"></i>
                                    </a>
                                    
                                    <form action="{{ route('jobseeker.applications.destroy', $application->id) }}" method="post" class="flex-1 md:flex-none inline" onsubmit="return confirm('Are you sure you want to withdraw this application?');">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="w-full text-center bg-white border border-gray-200 hover:bg-red-50 hover:border-red-200 text-red-500 hover:text-red-700 font-bold p-2.5 rounded-xl transition-colors shadow-sm" title="Withdraw Application">
                                            <i class="bi bi-trash text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                                
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
        </div>
    </div>
</x-apps.app-jobseeker>