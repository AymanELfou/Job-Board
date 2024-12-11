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
        transition: background-color 0.3s;
    }

    /* Active state for links */
    li a.active, li a:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* Icons alignment */
    .nav-item i {
        margin-right: 10px;
    }
</style>

<nav x-data="{ open: false }" class="bg-dark text-white" style="width: 330px; ">
    <div class="d-flex flex-column align-items-center p-3 min-vh-100">
        <!-- Centered Logo -->
        <a href="{{ route('jobseeker.dashboard') }}" class="d-flex align-items-center mb-4 text-decoration-none text-white">
            <img src="{{ asset('imgs/seeek.jpg') }}" alt="Logo" style="width: 200px; height: auto; border-radius: 30px" class=" mb-4"/>
        </a>

        <!-- Navigation Links -->
        <ul class="nav flex-column w-100 ml-4">
            <li class="nav-item mb-3">
                <a href="{{ route('jobseeker.dashboard') }}" class="nav-link text-white {{ request()->routeIs('jobseeker.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('jobseeker.jobs.index') }}" class="nav-link text-white {{ request()->routeIs('jobseeker.jobs.index') ? 'active' : '' }}">
                    <i class="bi bi-briefcase me-2"></i> Jobs
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('savedJobs.index') }}" class="nav-link text-white {{ request()->routeIs('savedJobs.index') ? 'active' : '' }}">
                    <i class="bi bi-bookmark me-2"></i> Saved Jobs
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('jobseeker.applications.index') }}" class="nav-link text-white {{ request()->routeIs('jobseeker.applications.index') ? 'active' : '' }}">
                    <i class="bi bi-inbox me-2"></i> Recent Applications

                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('profile.edit') }}" class="nav-link text-white {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <i class="bi bi-person-circle"></i> Profile

                </a>
            </li>
            {{-- <li class="nav-item mb-3">
                <a href="" class="nav-link text-white {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                    <i class="bi bi-bell"></i> Notification

                </a>
            </li> --}}
            <li class="nav-item mb-3">
                <a href="{{ route('logout') }}" class="nav-link text-white {{ request()->routeIs('logout') ? 'active' : '' }}">
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
