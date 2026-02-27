<x-apps.app-jobseeker>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center py-1 px-4 gap-2">
            <div class="ml-2">
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    Candidate <span class="text-[#a31b1b]">Dashboard</span>
                </h2>
                <p class="text-gray-400 text-sm font-medium">Welcome back! Here is a quick overview of your activities.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if (isset($success))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                     class="mb-6 bg-green-50 border border-green-200 text-green-800 rounded-2xl p-4 flex items-center justify-between shadow-sm transition-all duration-500">
                    <div class="flex items-center gap-3">
                        <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                        <span class="font-medium">{{ $success }}</span>
                    </div>
                    <button @click="show = false" class="text-green-600 hover:text-green-800 transition-colors">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            @endif

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                        <i class="bi bi-stars text-[#a31b1b]"></i>
                        Recommended Jobs
                    </h3>
                    <a href="{{ route('jobseeker.jobs.index') }}" class="text-sm font-bold text-[#a31b1b] hover:text-[#8a1717] transition-colors flex items-center gap-1">
                        View All <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                
                <div class="p-4 sm:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        <!-- Job Card 1 -->
                        <div class="group bg-white border border-gray-100 rounded-[1.5rem] p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 hover:border-[#a31b1b]/30 relative overflow-hidden flex flex-col h-full">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-[#a31b1b]/5 to-transparent rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                            
                            <div class="flex justify-between items-start mb-4 relative z-10">
                                <div class="w-12 h-12 bg-red-50 text-[#a31b1b] rounded-xl flex items-center justify-center shadow-sm">
                                    <i class="bi bi-headset text-2xl"></i>
                                </div>
                                <span class="bg-red-50 text-[#a31b1b] px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                                    Featured
                                </span>
                            </div>
                            
                            <h4 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">Chef de projet en centre d'appels</h4>
                            <p class="text-gray-500 text-sm mb-4 font-medium"><i class="bi bi-building mr-1"></i> myopla al hoceima</p>
                            
                            <div class="mt-auto pt-4 flex gap-2 w-full">
                                <button class="flex-1 bg-gray-50 hover:bg-gray-100 text-gray-700 font-bold py-2.5 rounded-xl transition-colors text-sm border border-gray-200">
                                    <i class="bi bi-bookmark"></i> Save
                                </button>
                                <button class="flex-1 bg-[#a31b1b] hover:bg-[#8a1717] text-white font-bold py-2.5 rounded-xl transition-all shadow-sm hover:shadow text-sm">
                                    View Details
                                </button>
                            </div>
                        </div>

                        <!-- Job Card 2 -->
                        <div class="group bg-white border border-gray-100 rounded-[1.5rem] p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 hover:border-[#a31b1b]/30 relative overflow-hidden flex flex-col h-full">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-blue-50 to-transparent rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                            
                            <div class="flex justify-between items-start mb-4 relative z-10">
                                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center shadow-sm">
                                    <i class="bi bi-bar-chart text-2xl"></i>
                                </div>
                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                                    New
                                </span>
                            </div>
                            
                            <h4 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">CS & Production Planning Analyst</h4>
                            <p class="text-gray-500 text-sm mb-4 font-medium"><i class="bi bi-geo-alt mr-1"></i> Multiple Locations</p>
                            
                            <div class="mt-auto pt-4 flex gap-2 w-full">
                                <button class="flex-1 bg-gray-50 hover:bg-gray-100 text-gray-700 font-bold py-2.5 rounded-xl transition-colors text-sm border border-gray-200">
                                    <i class="bi bi-bookmark"></i> Save
                                </button>
                                <button class="flex-1 bg-[#a31b1b] hover:bg-[#8a1717] text-white font-bold py-2.5 rounded-xl transition-all shadow-sm hover:shadow text-sm">
                                    View Details
                                </button>
                            </div>
                        </div>
                        
                        <!-- Job Card 3 -->
                        <div class="group bg-white border border-gray-100 rounded-[1.5rem] p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 hover:border-[#a31b1b]/30 relative overflow-hidden flex flex-col h-full">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-green-50 to-transparent rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                            
                            <div class="flex justify-between items-start mb-4 relative z-10">
                                <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center shadow-sm">
                                    <i class="bi bi-calculator text-2xl"></i>
                                </div>
                            </div>
                            
                            <h4 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">Responsable Administratif et Financier (RAF)</h4>
                            <p class="text-gray-500 text-sm mb-4 font-medium"><i class="bi bi-geo-alt mr-1"></i> Al Hoceima</p>
                            
                            <div class="mt-auto pt-4 flex gap-2 w-full">
                                <button class="flex-1 bg-gray-50 hover:bg-gray-100 text-gray-700 font-bold py-2.5 rounded-xl transition-colors text-sm border border-gray-200">
                                    <i class="bi bi-bookmark"></i> Save
                                </button>
                                <button class="flex-1 bg-[#a31b1b] hover:bg-[#8a1717] text-white font-bold py-2.5 rounded-xl transition-all shadow-sm hover:shadow text-sm">
                                    View Details
                                </button>
                            </div>
                        </div>

                    </div>
                    
                    <div class="mt-8 text-center">
                        <x-primary-button class="bg-gray-900 hover:bg-gray-800 text-white rounded-xl px-6 py-3">
                            Explore More Opportunities
                        </x-primary-button>
                    </div>
                </div>
            </div>

            <!-- Dashboard Stats Snapshot (Placeholder) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Stat Card 1 -->
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center text-2xl shadow-inner">
                        <i class="bi bi-send-check"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">Applied</p>
                        <h4 class="text-3xl font-black text-gray-900">0</h4>
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center text-2xl shadow-inner">
                        <i class="bi bi-bookmark-star"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">Saved Jobs</p>
                        <h4 class="text-3xl font-black text-gray-900">0</h4>
                    </div>
                </div>

                <!-- Stat Card 3 -->
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-green-50 text-green-500 flex items-center justify-center text-2xl shadow-inner">
                        <i class="bi bi-eye"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">Profile Views</p>
                        <h4 class="text-3xl font-black text-gray-900">0</h4>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-apps.app-jobseeker>
