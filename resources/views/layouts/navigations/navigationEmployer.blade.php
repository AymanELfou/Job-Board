<nav x-data="{ open: false }" class="text-white h-screen fixed sticky top-0 font-sans" style="width: 260px; background-color: #1a1a1a; overflow-y: hidden;">
    <div class="flex flex-col items-center p-4 h-full">
        <!-- Centered Logo -->
        <a href="{{ route('employer.dashboard') }}" class="flex items-center mb-6 no-underline">
            <div class="bg-white/5 p-2 rounded-full border border-white/5 transition-all duration-300 hover:bg-white/10">
                <img src="{{ asset('imgs/empj.png') }}" alt="Logo" class="w-24 h-24 object-cover rounded-full shadow-lg" />
            </div>
        </a>

        <!-- Navigation Links -->
        <ul class="flex flex-col w-full space-y-1 mt-2 px-1">
            <li>
                <a href="{{ route('employer.dashboard') }}" class="flex items-center w-full px-4 py-3 rounded-xl text-[1.05rem] font-semibold no-underline whitespace-nowrap transition-all duration-300 group {{ request()->routeIs('employer.dashboard') ? 'bg-[#a31b1b] text-white shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="bi bi-house-door-fill mr-4 text-xl {{ request()->routeIs('employer.dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('employer.jobs.index') }}" class="flex items-center w-full px-4 py-3 rounded-xl text-[1.05rem] font-semibold no-underline whitespace-nowrap transition-all duration-300 group {{ request()->routeIs('employer.jobs.index') ? 'bg-[#a31b1b] text-white shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="bi bi-briefcase-fill mr-4 text-xl {{ request()->routeIs('employer.jobs.index') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"></i>
                    <span>Job Postings</span>
                </a>
            </li>
            <li>
                <a href="{{ route('employer.applications.index') }}" class="flex items-center w-full px-4 py-3 rounded-xl text-[1.05rem] font-semibold no-underline whitespace-nowrap transition-all duration-300 group {{ request()->routeIs('employer.applications.index') ? 'bg-[#a31b1b] text-white shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="bi bi-inbox-fill mr-4 text-xl {{ request()->routeIs('employer.applications.index') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"></i>
                    <span>Applications</span>
                </a>
            </li>
            <li>
                <a href="{{ route('employer.candidates') }}" class="flex items-center w-full px-4 py-3 rounded-xl text-[1.05rem] font-semibold no-underline whitespace-nowrap transition-all duration-300 group {{ request()->routeIs('employer.candidates') ? 'bg-[#a31b1b] text-white shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="bi bi-people-fill mr-4 text-xl {{ request()->routeIs('employer.candidates') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"></i>
                    <span>Candidates</span>
                </a>
            </li>
            
            <li class="pt-4 pb-1">
                <div class="px-4 text-[0.7rem] font-bold text-gray-500 uppercase tracking-widest">Account</div>
            </li>
            
            <li>
                <a href="{{ route('employer.profile.edit') }}" class="flex items-center w-full px-4 py-3 rounded-xl text-[1.05rem] font-semibold no-underline whitespace-nowrap transition-all duration-300 group {{ request()->routeIs('employer.profile.edit') ? 'bg-[#a31b1b] text-white shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="bi bi-building-fill-gear mr-4 text-xl {{ request()->routeIs('employer.profile.edit') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"></i>
                    <span>Company Profile</span>
                </a>
            </li>
        </ul>
        
        <!-- Bottom Logout -->
        <div class="mt-auto w-full pt-4 cursor-pointer px-1">
            <a href="/employer/logout" class="flex items-center w-full px-4 py-3 rounded-xl text-[1.05rem] font-semibold text-red-500 no-underline whitespace-nowrap hover:bg-red-500/10 hover:text-red-400 transition-all duration-300 group">
                <i class="bi bi-box-arrow-right mr-4 text-xl"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>
</nav>

<!-- Responsive Navigation Menu -->
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#1a1a1a] font-sans">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('employer.dashboard')" :active="request()->routeIs('employer.dashboard')" class="text-white hover:bg-white/10 no-underline text-base font-medium">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('employer.jobs.index')" :active="request()->routeIs('employer.jobs.index')" class="text-white hover:bg-white/10 no-underline text-base font-medium">
            {{ __('Jobs') }}
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
