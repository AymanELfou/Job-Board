<x-apps.app-employer>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center py-1 px-4 gap-2">
            <div class="ml-2">
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    Job <span class="text-[#a31b1b]">Management</span>
                </h2>
                <p class="text-gray-400 text-sm font-medium">Manage your job postings</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('employer.jobs.create') }}" class="inline-flex items-center gap-2 bg-[#a31b1b] hover:bg-[#8a1717] text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-sm hover:shadow-md">
                    <i class="bi bi-plus-lg text-lg"></i>
                    Add Job
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6">
                @include('incs.alert')
            </div>

            <!-- Search Bar -->
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 mb-8">
                <form action="{{ route('employer.jobs.search') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="relative flex-grow">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i class="bi bi-search"></i>
                        </div>
                        <input name="keyword" type="search" placeholder="Title, Job type, Location" class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#a31b1b] focus:border-transparent transition-all duration-300 outline-none text-gray-700">
                    </div>
                    <button type="submit" class="bg-[#a31b1b] hover:bg-[#8a1717] text-white px-8 py-3 rounded-xl font-bold transition-all duration-300 shadow-sm hover:shadow-md flex-shrink-0">
                        Search
                    </button>
                </form>
            </div>

            <!-- Jobs Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($jobs as $job)
                    <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 flex flex-col h-full group">
                        
                        <!-- Header -->
                        <div class="mb-4">
                            <h5 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#a31b1b] transition-colors duration-300">{{ $job['titre'] }}</h5>
                            <div class="flex items-center gap-2 text-gray-500 text-sm font-medium">
                                <i class="bi bi-geo-alt-fill text-[#a31b1b]/70"></i>
                                {{ $job['location'] }}
                            </div>
                        </div>
                        
                        <!-- Details -->
                        <div class="space-y-3 mb-6 bg-gray-50/50 p-4 rounded-xl border border-gray-50">
                            <div class="flex items-center gap-3 text-sm text-gray-700">
                                <i class="bi bi-briefcase text-gray-400 w-5"></i>
                                <span class="font-medium text-gray-500 w-24">Type:</span>
                                <span class="font-bold">{{ $job['job_type'] }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-700">
                                <i class="bi bi-tag text-gray-400 w-5"></i>
                                <span class="font-medium text-gray-500 w-24">Category:</span>
                                <span class="font-bold">{{ $job['categorie'] }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-700">
                                <i class="bi bi-currency-dollar text-gray-400 w-5"></i>
                                <span class="font-medium text-gray-500 w-24">Salary:</span>
                                <span class="font-bold">{{ $job['salaire'] }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-700">
                                <i class="bi bi-file-earmark-text text-gray-400 w-5"></i>
                                <span class="font-medium text-gray-500 w-24">Contract:</span>
                                <span class="font-bold px-2 py-1 bg-white border border-gray-200 rounded-md text-xs">{{ $job['type_contrat'] }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-700">
                                <i class="bi bi-clock-history text-gray-400 w-5"></i>
                                <span class="font-medium text-gray-500 w-24">Published:</span>
                                <span class="font-bold">{{ $job['date_publication'] }}</span>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div class="mb-6 flex-grow">
                            <h6 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Description</h6>
                            <p class="text-gray-600 text-sm leading-relaxed">{{ \Illuminate\Support\Str::limit($job['description'], 150, '...') }}</p>
                        </div>
                        
                        <!-- Actions -->
                        <div class="pt-4 border-t border-gray-100 mt-auto flex justify-end gap-3">
                            <a href="/employer/jobs/{{ $job->id }}/edit" class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-300">
                                <i class="bi bi-pencil-square text-lg"></i>
                            </a>
                            <form action="{{ route('employer.jobs.destroy', $job->id) }}" method="post" class="m-0">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this job posting?')" class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all duration-300">
                                    <i class="bi bi-trash3 text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex justify-center">
                {{ $jobs->links() }}
            </div>
            
        </div>
    </div>
</x-apps.app-employer>