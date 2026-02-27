<x-apps.app-employer>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center py-1 px-4 gap-2">
            <div class="ml-2">
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    Account <span class="text-[#a31b1b]">Settings</span>
                </h2>
                <p class="text-gray-400 text-sm font-medium">Update your profile, password, or delete your account</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Update Profile Information -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                        <i class="bi bi-person-lines-fill text-[#a31b1b]"></i>
                        Profile Information
                    </h3>
                </div>
                <div class="p-8 sm:p-10">
                    <div class="max-w-2xl">
                        @include('Employer.profile.profile-information')
                    </div>
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                        <i class="bi bi-shield-lock-fill text-blue-500"></i>
                        Update Password
                    </h3>
                </div>
                <div class="p-8 sm:p-10">
                    <div class="max-w-2xl">
                        @include('Employer.profile.update-password')
                    </div>
                </div>
            </div>

            <!-- Delete User -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-red-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-red-100 bg-red-50/50">
                    <h3 class="text-xl font-bold text-red-700 flex items-center gap-3">
                        <i class="bi bi-exclamation-triangle-fill text-red-500"></i>
                        Danger Zone
                    </h3>
                </div>
                <div class="p-8 sm:p-10 bg-red-50/10">
                    <div class="max-w-2xl">
                        @include('Employer.profile.delete-user')
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-apps.app-employer>
