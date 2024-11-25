<x-apps.app-jobseeker>
    <x-slot name="header">
        <h2 class="h2 text-dark" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body text-dark">
                    {{ __("You're logged in As Job Seeker!") }}
                </div>
            </div>
        </div>
    </div>
</x-apps.app-jobseeker>
