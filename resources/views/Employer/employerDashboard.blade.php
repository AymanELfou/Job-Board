<x-apps.app-employer>
    <x-slot name="header">
        <h1 class="h2 text-dark" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
            {{ __('Dashboard') }}
        </h1>
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
