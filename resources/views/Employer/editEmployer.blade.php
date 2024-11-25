<x-apps.app-employer>
    <x-slot name="header">
        <h1 class="  text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('Employer.profile.profile-information')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('Employer.profile.update-password')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('Employer.profile.delete-user')
                </div>
            </div>
        </div>
    </div>
</x-apps.app-employer>
