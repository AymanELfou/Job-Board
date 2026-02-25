<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center py-2 px-4 mb-4">
            <h2 class="text-5xl font-extrabold text-gray-900 tracking-tight">
                Job <span class="text-[#a31b1b]">Management</span>
            </h2>
            <nav class="flex text-xl font-extrabold text-[#a31b1b] gap-6">
                <span class="border-b-4 border-[#a31b1b] pb-1 cursor-default">All Listings</span>
            </nav>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Hero Search Section -->
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 mb-12">
                <div class="max-w-3xl mx-auto text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Find & Manage Postings</h3>
                    <p class="text-gray-500">Search through active job listings by category, location, or type.</p>
                </div>

                <form action="{{ route('jobs.search') }}" method="GET" class="relative max-w-4xl mx-auto">
                    <div class="flex items-center bg-gray-50 rounded-2xl p-2 border border-gray-100 focus-within:border-[#a31b1b] focus-within:ring-4 focus-within:ring-[#a31b1b]/5 transition-all shadow-inner">
                        <div class="pl-4 pr-2 text-gray-400">
                            <i class="bi bi-search text-xl"></i>
                        </div>
                        <input 
                            name="keyword" 
                            type="text" 
                            class="w-full bg-transparent border-none focus:ring-0 py-3 text-lg font-medium text-gray-700 placeholder-gray-400" 
                            placeholder="Search by category, location, or job type..."
                            autocomplete="off"
                        >
                        <button type="submit" class="bg-[#a31b1b] text-white px-8 py-3 rounded-xl font-bold hover:bg-[#821515] transition-all shadow-lg shadow-[#a31b1b]/20 active:scale-95">
                            Search
                        </button>
                    </div>
                </form>
            </div>

            <!-- Content Area -->
            <div class="space-y-8">
                <div class="flex items-center justify-between px-4">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-8 bg-[#a31b1b] rounded-full"></div>
                        <h4 class="text-xl font-bold text-gray-800">Global Listings</h4>
                    </div>
                    {{-- <a href="{{ route('jobs.create') }}" class="flex items-center gap-2 text-[#a31b1b] font-bold hover:underline transition-all">
                        <i class="bi bi-plus-circle-fill"></i> New Posting
                    </a> --}}
                </div>

                <div class="px-4">
                    @include('incs.alert')
                    <x-job-list :jobs="$jobs" />
                </div>
            </div>

        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    @endpush
</x-app-layout>
