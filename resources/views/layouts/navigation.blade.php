<nav x-data="{ open: false }" style="width: 350px; background-color: #343a40;">
    <div class="d-flex flex-column align-items-center p-3 min-vh-100">
        <!-- Centered Logo -->
        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center mb-4 text-decoration-none text-white">
            <img src="{{ asset('imgs/Admin.png') }}" alt="modify" style="width: 280px; height: 250px;" />
        </a>

        <!-- Centered Navigation Links --> 
        <div class="mt-5" >
            <ul class="nav nav-pills flex-column w-100 text-center mt-5" style="width: 500px">
                <li class="nav-item ">
                    <a href="{{ route('admin.dashboard') }}" class="mx-5 nav-link fs-5 text-white fw-bold {{ request()->routeIs('dashboard') ? 'active  danger' : '' }}" style=" background-color: rgba(107, 180, 92, 0.705); 
        border-radius: 15px; 
        color: white;
        transition: background-color 0.3s; padding:10px; ">
                        Dashboard
                    </a>
                </li>
                <li>
                    <i><h3 class="mb-2 mt-5 text-white">Management</h3></i>
                </li>
                <li>
                    <a href="{{ route('jobs.index') }}" class="nav-link fs-5 text-white fw-bold mt-4 {{ request()->routeIs('jobs.index') ? 'active  ' : '' }}">
                        Job Management
                    </a>
                </li>
                <li>
                    <a href="{{ route('jobseeker.index') }}" class="nav-link fs-5 text-white fw-bold mt-4 {{ request()->routeIs('jobseeker.index') ? 'active  ' : '' }}">
                        User Management
                    </a>
                </li>
                <li>
                    <a href="{{ route('applications.index') }}" class="nav-link fs-5 text-white fw-bold mt-4 {{ request()->routeIs('applications.index') ? 'active  ' : '' }}">
                        Application Management
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
