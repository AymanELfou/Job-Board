<style>
    /* General link styles */
    li a {
        text-decoration: none;
        color: white;
        font-size: 15px;
        padding: 10px 20px;
        text-align: left;
        width: 100%;
        display: flex;
        align-items: center;
        border-radius: 10px;
        transition: background-color 0.3s, border 0.3s; /* Added transition for border */
        border: 1px solid  white; /* Initial transparent border */
        margin-left:20px; 
    }

    /* Active state for links */
    li a.active, li a:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(233, 225, 225, 0.3); /* Reduced border on hover and active */
        transition: 0.3s, border 0.5ms;
        tar 
    }

    /* Icons alignment */
    .nav-item i {
        margin-right: 10px;
    }
</style>

<nav x-data="{ open: false }" class=" text-white" style="width: 330px; background-color: #a31b1b;">
    <div class="d-flex flex-column align-items-center p-3 min-vh-100">
        <!-- Centered Logo -->
        <a href="{{ route('employer.dashboard') }}" class="d-flex align-items-center mb-4 text-decoration-none text-white">
            <img src="{{ asset('imgs/empj.png') }}" alt="Logo" style="width: 200px; height: auto;" class="rounded mb-4" />
        </a>

        <!-- Navigation Links -->
        <ul class="nav flex-column w-100">
            <li class="nav-item mb-3">
                <a href="{{ route('employer.dashboard') }}" class="nav-link text-white {{ request()->routeIs('employer.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('employer.jobs.index') }}" class="nav-link text-white {{ request()->routeIs('employer.jobs.index') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-data me-2"></i> Job Postings Management
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('employer.applications.index') }}" class="nav-link text-white {{ request()->routeIs('employer.applications.index') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text me-2"></i> Applications Management
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('employer.candidates') }}" class="nav-link text-white {{ request()->routeIs('employer.candidates') ? 'active' : '' }}">
                    <i class="bi bi-inbox me-2"></i> Candidates

                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('employer.profile.edit') }}" class="nav-link text-white {{ request()->routeIs('employer.profile.edit') ? 'active' : '' }}">
                    <i class="bi bi-person-circle"></i> Company Profile

                </a>
            </li>
            {{-- <li class="nav-item mb-3">
                <a href="" class="nav-link text-white {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                    <i class="bi bi-bell"></i> Notification

                </a>
            </li> --}}
            <li class="nav-item mb-3">
                <a href="/employer/logout" class="nav-link text-white {{ request()->routeIs('logout') ? 'active' : '' }}">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>




{{-- "{{ route('jobs.index') }}" class="nav-link text-white {{ request()->routeIs('jobs.index') ? 'active bg-secondary' : '' }}"
 --}}{{-- <a href="{{ route('jobseeker.dashboard') }}" class="nav-link text-white {{ request()->routeIs('jobseeker.dashboard') ? 'active bg-secondary' : '' }}" style="border-radius: 10px;">
    <i class="bi bi-house-door me-2"></i> Dashboard
</a> --}}








    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>


        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                {{-- <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link> --}}

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
