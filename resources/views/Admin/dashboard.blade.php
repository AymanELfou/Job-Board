<x-app-layout>
    <x-slot name="header">
        <h2 class="h1 text-dark" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body text-dark">
                    {{ __("You're logged in As ADMIN !") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>





