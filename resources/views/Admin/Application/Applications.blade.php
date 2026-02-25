<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center py-2 gap-4">
            <div class="mt-4">
                <h2 class="text-5xl font-extrabold text-gray-900 tracking-tight">
                    Application <span class="text-[#a31b1b]">Management</span>
                </h2>
                <p class="text-gray-500 text-lg mt-1 font-medium">Review and track candidate submissions</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Hero Search Section -->
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 mb-12">
                <div class="max-w-3xl mx-auto text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Search Applications</h3>
                    <p class="text-gray-500">Filter submissions by applicant name or job title.</p>
                </div>

                <form action="{{ route('applications.search') }}" method="GET" class="relative max-w-4xl mx-auto">
                    <div class="flex items-center bg-gray-50 rounded-2xl p-2 border border-gray-100 focus-within:border-[#a31b1b] transition-all shadow-inner">
                        <div class="pl-4 pr-2 text-gray-400">
                            <i class="bi bi-search text-xl"></i>
                        </div>
                        <input 
                            name="quer" 
                            type="text" 
                            class="w-full bg-transparent border-none focus:ring-0 py-3 text-lg font-medium text-gray-700 placeholder-gray-400" 
                            placeholder="Search by candidate name or job title..."
                        >
                        <button type="submit" class="bg-[#a31b1b] text-white px-8 py-3 rounded-xl font-bold hover:bg-[#821515] transition-all shadow-lg shadow-[#a31b1b]/20">
                            Search
                        </button>
                    </div>
                </form>
            </div>

            <!-- Applications List -->
            <div class="space-y-8">
                <div class="flex items-center justify-between px-4">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-8 bg-[#a31b1b] rounded-full"></div>
                        <h4 class="text-xl font-bold text-gray-800">Recent Submissions</h4>
                    </div>
                </div>

                <div class="px-4">
                    @include('incs.alert')
                    @if($applications->isEmpty())
                        <div class="bg-white rounded-3xl p-12 text-center border-2 border-dashed border-gray-200">
                            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="bi bi-file-earmark-text text-4xl text-gray-300"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">No Applications Found</h3>
                            <p class="text-gray-500">There are currently no job applications to review.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($applications as $application)
                            <div class="bg-white rounded-[1.5rem] p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
                                <div class="grid grid-cols-1 md:grid-cols-5 gap-6 items-center">
                                    
                                    <!-- Job Preview -->
                                    <div class="md:col-span-2 flex items-center gap-4">
                                        <div class="w-14 h-14 rounded-2xl bg-[#a31b1b]/5 flex items-center justify-center text-xl text-[#a31b1b] border border-[#a31b1b]/10 group-hover:bg-[#a31b1b] group-hover:text-white transition-all">
                                            <i class="bi bi-briefcase"></i>
                                        </div>
                                        <div>
                                            <span class="text-xs font-bold text-[#a31b1b] uppercase tracking-widest">Applying for</span>
                                            <h3 class="text-lg font-extrabold text-gray-900 truncate">{{ $application->job->titre ?? 'Untitled Position' }}</h3>
                                        </div>
                                    </div>

                                    <!-- Candidate -->
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 border border-gray-200">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <div>
                                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Candidate</span>
                                            <p class="text-sm font-bold text-gray-700">{{ $application->profilJobseeker->fullName ?? 'Unknown User' }}</p>
                                        </div>
                                    </div>

                                    <!-- Status Controller -->
                                    <div>
                                        <form action="{{ route('updateStatus', $application->id) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('PUT')
                                            <div class="relative">
                                                <select name="status" onchange="this.form.submit()" class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm font-bold px-4 py-2.5 focus:ring-[#a31b1b]/10 focus:border-[#a31b1b] transition-all appearance-none cursor-pointer">
                                                    <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                                    <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>✅ Approved</option>
                                                    <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>❌ Rejected</option>
                                                </select>
                                                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                                    <i class="bi bi-chevron-down text-xs"></i>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('applications.show', $application->id) }}" class="w-10 h-10 rounded-xl bg-gray-50 text-gray-400 hover:bg-[#a31b1b] hover:text-white flex items-center justify-center transition-all border border-gray-200 hover:border-[#a31b1b]">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <form action="{{ route('applications.destroy', $application->id) }}" method="post" class="m-0">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="w-10 h-10 rounded-xl bg-gray-50 text-gray-400 hover:bg-red-50 hover:text-red-500 flex items-center justify-center transition-all border border-gray-200 hover:border-red-100" onclick="return confirm('Definitively delete this application record?')">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    @endpush
</x-app-layout>
