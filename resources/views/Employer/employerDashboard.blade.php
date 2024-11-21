<x-apps.app-employer>
    <x-slot name="header">
        <h2 class="h2 text-dark">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class=" shadow-sm">
                <div class="card-body text-dark alert alert-primary">
                    {{ __("You're logged in As Employer!") }}
                </div>
            </div>
        </div>
    </div>
</x-apps.app-employer>
