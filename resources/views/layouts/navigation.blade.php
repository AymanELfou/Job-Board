<style>
    /* General link styles */
    li a {
        text-decoration: none;
        color: white;
        font-size: 22px;
        padding: 10px 20px;
        text-align: left;
        width: 100%;
        display: flex;
        align-items: center;
        border-radius: 10px;
        transition: background-color 0.3s;
        font-family: 'Montserrat', sans-serif;

    }
    h5{
        text-align: left;
        font-family: 'Montserrat', sans-serif;
    }

    /* Active state for links */
    li a.active, li a:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* Icons alignment */
    .nav-item i {
        margin-right: 10px;
    }
    ul li {
        font-size: 19px;
    }
</style>

<nav x-data="{ open: false }" class="text-white" style="width: 330px; background-color: rgb(43, 43, 129)" >
    <div class="d-flex flex-column align-items-center p-3 min-vh-100">
        <!-- Centered Logo -->
        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none text-white">
            <img src="{{ asset('imgs/admin.avif') }}" alt="modify" style="width: 260px; height: 250px; border-radius: 30px" />
        </a>

        <!-- Centered Navigation Links -->
        <div class="mt-5">
            <ul class="nav flex-column w-100 text-center">
                <li class="nav-item mb-3">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid"></i>Dashboard
                    </a>
                </li>
                <li>
                    <h5 class="mb-3 mt-2 ml-4 text-white">                        
                        <i class="bi bi-gear me-1 "></i> Management
                    </h5>
                </li>
                <li class="nav-item mb-3 ml-4">
                    <a href="{{ route('jobs.index') }}" class="nav-link text-white  {{ request()->routeIs('jobs.index') ? 'active' : '' }}">
                        <i class="bi bi-briefcase me-2"></i> Job Management
                    </a>
                </li>
                <li class="nav-item mb-3 ml-4">
                    <a href="{{ route('jobseeker.index') }}" class="nav-link text-white  {{ request()->routeIs('jobseeker.index') ? 'active' : '' }}">
                        <i class="bi bi-person-fill me-2 "></i> User Management
                    </a>
                </li>
                <li class="nav-item mb-3 ml-4">
                    <a href="{{ route('applications.index') }}" class="nav-link text-white  {{ request()->routeIs('applications.index') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text me-2"></i> Application Management
                    </a>
                </li>
                <li class="nav-item mb-3 ml-1">
                    <a href="{{ route('admin.logout') }}" class="nav-link text-white {{ request()->routeIs('logout') ? 'active' : '' }}">
                        <i class="bi bi-box-arrow-right"></i>Logout
                    </a>
                </li>
                <!-- Add more links here as needed -->
            </ul>
        </div>
    </div>
</nav>


    








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
