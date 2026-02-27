<nav x-data="{ open: false }" class="text-white h-screen fixed sticky top-0 font-sans border-r border-slate-800" style="width: 260px; background-color: #0f172a; overflow-y: hidden;">
    <div class="flex flex-col items-center p-4 h-full">
        
        <!-- Centered Logo -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center mb-6 mt-2 no-underline">
            <div class="bg-white/5 p-2 rounded-full border border-white/5 transition-all duration-300 hover:bg-white/10">
                <img src="{{ asset('imgs/admin.avif') }}" alt="Admin Dashboard" class="w-24 h-24 object-cover rounded-full shadow-lg" />
            </div>
        </a>

        <!-- Navigation Links -->
        <ul class="flex flex-col w-full space-y-1 mt-2 px-1 m-0 p-0 list-none">
            
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center w-full px-4 py-3 rounded-xl text-[1.05rem] font-semibold no-underline whitespace-nowrap transition-all duration-300 group {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700 text-white shadow-md' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="bi bi-grid-fill mr-4 text-xl {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="pt-4 pb-1">
                <div class="px-4 text-[0.7rem] font-bold text-slate-500 uppercase tracking-widest">Management</div>
            </li>

            <li>
                <a href="{{ route('jobs.index') }}" class="flex items-center w-full px-4 py-3 rounded-xl text-[1.05rem] font-semibold no-underline whitespace-nowrap transition-all duration-300 group {{ request()->routeIs('jobs.index') || request()->routeIs('jobs.*') ? 'bg-slate-700 text-white shadow-md' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="bi bi-briefcase-fill mr-4 text-xl {{ request()->routeIs('jobs.index') || request()->routeIs('jobs.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                    <span>Jobs</span>
                </a>
            </li>

            <li>
                <a href="{{ route('jobseeker.index') }}" class="flex items-center w-full px-4 py-3 rounded-xl text-[1.05rem] font-semibold no-underline whitespace-nowrap transition-all duration-300 group {{ request()->routeIs('jobseeker.index') || request()->routeIs('jobseeker.*') ? 'bg-slate-700 text-white shadow-md' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="bi bi-people-fill mr-4 text-xl {{ request()->routeIs('jobseeker.index') || request()->routeIs('jobseeker.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                    <span>Users</span>
                </a>
            </li>

            <li>
                <a href="{{ route('applications.index') }}" class="flex items-center w-full px-4 py-3 rounded-xl text-[1.05rem] font-semibold no-underline whitespace-nowrap transition-all duration-300 group {{ request()->routeIs('applications.index') || request()->routeIs('applications.*') ? 'bg-slate-700 text-white shadow-md' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="bi bi-file-earmark-text-fill mr-4 text-xl {{ request()->routeIs('applications.index') || request()->routeIs('applications.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                    <span>Applications</span>
                </a>
            </li>

        </ul>
        
        <!-- Bottom Logout -->
        <div class="mt-auto w-full pt-4 cursor-pointer px-1 border-t border-slate-800">
            <a href="{{ route('admin.logout') }}" class="flex items-center w-full px-4 py-3 rounded-xl text-[1.05rem] font-semibold text-red-500 no-underline whitespace-nowrap hover:bg-red-500/10 hover:text-red-400 transition-all duration-300 group">
                <i class="bi bi-box-arrow-right mr-4 text-xl"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>
</nav>

<!-- Responsive Navigation Menu (Mobile) -->
<div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-[#0f172a] border-b border-slate-800 font-sans">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-white hover:bg-slate-800 no-underline text-base font-bold">
            <i class="bi bi-grid-fill mr-2"></i> {{ __('Dashboard') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('jobs.index')" :active="request()->routeIs('jobs.*')" class="text-white hover:bg-slate-800 no-underline text-base font-bold">
            <i class="bi bi-briefcase-fill mr-2"></i> {{ __('Jobs') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('jobseeker.index')" :active="request()->routeIs('jobseeker.*')" class="text-white hover:bg-slate-800 no-underline text-base font-bold">
            <i class="bi bi-people-fill mr-2"></i> {{ __('Users') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('applications.index')" :active="request()->routeIs('applications.*')" class="text-white hover:bg-slate-800 no-underline text-base font-bold">
            <i class="bi bi-file-earmark-text-fill mr-2"></i> {{ __('Applications') }}
        </x-responsive-nav-link>
    </div>

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t border-slate-800">
        <div class="px-4">
            <div class="font-bold text-base text-white">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-slate-400">{{ Auth::user()->email }}</div>
        </div>

        <div class="mt-3 space-y-1">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-red-400 hover:bg-red-500/10 hover:text-red-300 no-underline font-bold">
                    <i class="bi bi-box-arrow-right mr-2"></i> {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</div>
