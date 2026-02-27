<nav x-data="{ open: false }" class="text-white h-screen fixed sticky top-0 font-sans" style="width: 260px; background-color: #1a1a1a; overflow-y: hidden;">
    <div class="flex flex-col items-center p-4 h-full">
        <!-- Centered Logo -->
        <a href="{{ route('jobseeker.dashboard') }}" class="flex items-center mb-6 no-underline">
            <div class="bg-white/5 p-2 rounded-full border border-white/5 transition-all duration-300 hover:bg-white/10">
                <img src="{{ asset('imgs/seeek.jpg') }}" alt="Logo" class="w-24 h-24 object-cover rounded-full shadow-lg" />
            </div>
        </a>

        <!-- Navigation Links -->
        <ul class="flex flex-col w-full space-y-1 mt-2 px-1">
            <li>
                <a href="{{ route('jobseeker.dashboard') }}" class="flex items-center w-full px-4 py-3 rounded-xl text-[1.05rem] font-semibold no-underline whitespace-nowrap transition-all duration-300 group {{ request()->routeIs('jobseeker.dashboard') ? 'bg-[#a31b1b] text-white shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="bi bi-house-door-fill mr-4 text-xl {{ request()->routeIs('jobseeker.dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('jobseeker.jobs.index') }}" class="flex items-center w-full px-4 py-3 rounded-xl text-[1.05rem] font-semibold no-underline whitespace-nowrap transition-all duration-300 group {{ request()->routeIs('jobseeker.jobs.index') ? 'bg-[#a31b1b] text-white shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="bi bi-briefcase-fill mr-4 text-xl {{ request()->routeIs('jobseeker.jobs.index') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"></i>
                    <span>Find Jobs</span>
                </a>
            </li>
            <li>
                <a href="{{ route('savedJobs.index') }}" class="flex items-center w-full px-4 py-3 rounded-xl text-[1.05rem] font-semibold no-underline whitespace-nowrap transition-all duration-300 group {{ request()->routeIs('savedJobs.index') ? 'bg-[#a31b1b] text-white shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="bi bi-bookmark-fill mr-4 text-xl {{ request()->routeIs('savedJobs.index') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"></i>
                    <span>Saved Jobs</span>
                </a>
            </li>
            <li>
                <a href="{{ route('jobseeker.applications.index') }}" class="flex items-center w-full px-4 py-3 rounded-xl text-[1.05rem] font-semibold no-underline whitespace-nowrap transition-all duration-300 group {{ request()->routeIs('jobseeker.applications.index') ? 'bg-[#a31b1b] text-white shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="bi bi-inbox-fill mr-4 text-xl {{ request()->routeIs('jobseeker.applications.index') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"></i>
                    <span>Applications</span>
                </a>
            </li>
            
            <li class="pt-4 pb-1">
                <div class="px-4 text-[0.7rem] font-bold text-gray-500 uppercase tracking-widest">Account</div>
            </li>
            
            <li>
                <a href="{{ route('profile.edit') }}" class="flex items-center w-full px-4 py-3 rounded-xl text-[1.05rem] font-semibold no-underline whitespace-nowrap transition-all duration-300 group {{ request()->routeIs('profile.edit') ? 'bg-[#a31b1b] text-white shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="bi bi-person-circle mr-4 text-xl {{ request()->routeIs('profile.edit') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"></i>
                    <span>Profile</span>
                </a>
            </li>
        </ul>
        
        <!-- Bottom Logout -->
        <div class="mt-auto w-full pt-4 cursor-pointer px-1">
            <a href="{{ route('logout') }}" class="flex items-center w-full px-4 py-3 rounded-xl text-[1.05rem] font-semibold text-red-500 no-underline whitespace-nowrap hover:bg-red-500/10 hover:text-red-400 transition-all duration-300 group">
                <i class="bi bi-box-arrow-right mr-4 text-xl"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>
</nav>

<!-- Responsive Navigation Menu -->
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#1a1a1a] font-sans">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('jobseeker.dashboard')" :active="request()->routeIs('jobseeker.dashboard')" class="text-white hover:bg-white/10 no-underline text-base font-medium">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('jobseeker.jobs.index')" :active="request()->routeIs('jobseeker.jobs.index')" class="text-white hover:bg-white/10 no-underline text-base font-medium">
            {{ __('Find Jobs') }}
        </x-responsive-nav-link>
    </div>

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t border-gray-700">
        <div class="px-4">
            <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
        </div>

        <div class="mt-3 space-y-1">
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-red-400 hover:bg-red-500/10 no-underline text-base font-medium">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</div>
