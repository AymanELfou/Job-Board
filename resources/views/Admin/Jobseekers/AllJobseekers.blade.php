<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center py-2 gap-4">
            <div class="mt-4">
                <h2 class="text-5xl font-extrabold text-gray-900 tracking-tight">
                    User <span class="text-[#a31b1b]">Management</span>
                </h2>
                <p class="text-gray-500 text-lg mt-1 font-medium">Review and manage platform participants</p>
            </div>
            
            <!-- Segmented Control Hub -->
            <div class="flex bg-gray-100 p-1.5 rounded-2xl border border-gray-200 w-full md:w-auto">
                <a href="{{ route('jobseeker.index') }}" class="flex-1 md:flex-none px-6 py-2 rounded-xl text-sm font-bold transition-all shadow-sm bg-white text-[#a31b1b] border border-gray-100">
                    <i class="bi bi-person-badge me-2"></i>Job Seekers
                </a>
                <a href="{{ route('employers.index') }}" class="flex-1 md:flex-none px-6 py-2 rounded-xl text-sm font-bold transition-all text-gray-500 hover:text-gray-700">
                    <i class="bi bi-building me-2"></i>Employers
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Search & Analytics Header -->
            <div class="grid grid-cols-1 lg:grid-cols-1 gap-8 mb-12">
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
                    <form action="{{ route('jobseeker.search') }}" method="GET" class="relative">
                        <div class="flex items-center bg-gray-50 rounded-2xl p-2 border border-gray-100 focus-within:border-[#a31b1b] transition-all">
                            <div class="pl-4 pr-2 text-gray-400">
                                <i class="bi bi-search"></i>
                            </div>
                            <input 
                                name="fullName" 
                                type="text" 
                                class="w-full bg-transparent border-none focus:ring-0 py-3 text-lg font-medium text-gray-700 placeholder-gray-400" 
                                placeholder="Search candidates by name..."
                            >
                            <button type="submit" class="bg-[#a31b1b] text-white px-8 py-3 rounded-xl font-bold hover:bg-[#821515] transition-all">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Participants Grid -->
            <div class="space-y-8">
                <div class="flex items-center justify-between px-4">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-8 bg-[#a31b1b] rounded-full"></div>
                        <h4 class="text-xl font-bold text-gray-800">Candidate Directory</h4>
                    </div>
                </div>

                <div class="px-4">
                    @include('incs.alert')
                    <div class="row g-4">
                        @foreach($Jobseekers as $jobseeker)
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 group flex flex-col h-100">
                                <div class="flex items-center gap-4 mb-6">
                                    <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center text-2xl text-[#a31b1b] border border-gray-100 group-hover:bg-[#a31b1b] group-hover:text-white transition-all">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-extrabold text-gray-900 leading-tight">{{ $jobseeker['fullName'] }}</h3>
                                        <span class="text-xs font-bold text-[#a31b1b] uppercase tracking-widest">Candidate</span>
                                    </div>
                                </div>

                                <div class="space-y-3 mb-6 flex-grow">
                                    <div class="flex items-start gap-3 text-sm">
                                        <i class="bi bi-envelope text-[#a31b1b] mt-0.5"></i>
                                        <span class="text-gray-600 truncate">{{ $jobseeker['contact_information'] }}</span>
                                    </div>
                                    <div class="flex items-start gap-3 text-sm">
                                        <i class="bi bi-mortarboard text-[#a31b1b] mt-0.5"></i>
                                        <span class="text-gray-600">{{ $jobseeker['education'] }}</span>
                                    </div>
                                    <div class="flex items-start gap-3 text-sm">
                                        <i class="bi bi-briefcase text-[#a31b1b] mt-0.5"></i>
                                        <span class="text-gray-600">{{ $jobseeker['experience'] }} years experience</span>
                                    </div>
                                    
                                    <div class="pt-4 border-t border-gray-50 mt-4">
                                        <h5 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Core Skills</h5>
                                        <div class="flex flex-wrap gap-1">
                                            @foreach(explode(',', $jobseeker['competences']) as $skill)
                                                <span class="px-2 py-1 bg-gray-50 text-gray-600 rounded-md text-[10px] font-bold border border-gray-100">{{ trim($skill) }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="flex gap-2 pt-4 border-t border-gray-50">
                                    <form action="{{ route('jobseeker.destroy', $jobseeker->id) }}" method="post" class="flex-1">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="w-full py-2.5 rounded-xl bg-gray-50 text-gray-400 hover:bg-red-50 hover:text-red-500 transition-all font-bold text-sm border border-gray-100 hover:border-red-100" onclick="return confirm('Remove candidate account definitively?')">
                                            <i class="bi bi-trash3 me-1"></i> Delete
                                        </button>
                                    </form>
                                    <a href="#" class="px-4 py-2.5 rounded-xl bg-[#a31b1b] text-white hover:bg-[#821515] transition-all font-bold text-sm shadow-sm">
                                        <i class="bi bi-file-earmark-pdf me-1"></i> CV
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-12 d-flex justify-content-center">
                        {{ $Jobseekers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    @endpush
</x-app-layout>
