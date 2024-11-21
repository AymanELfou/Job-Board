

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/btn.css') }}">
    <style>
        /* custom.css */
.card {
    background-color: #f8f9fa; /* Light background for the card */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    padding: 20px; /* Padding inside the card */
}

header {
    border-bottom: 2px solid #007bff; /* Blue bottom border */
    padding-bottom: 10px; /* Padding below the header */
    margin-bottom: 20px; /* Space below the header */
}

h1 {
    color: #343a40; /* Darker text color for the header */
    font-family: Verdana, Geneva, Tahoma, sans-serif;
}

p {
    color: #6c757d; /* Gray text color for the description */
}

    </style>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<div class="container">
    <section>
        <header class="mt-5">
            <h1 class=" font-medium text-gray-900">
                {{ __('Create Your Profile') }}
            </h1>
            <p class="mt-1 fs-4 text-gray-600">
                {{ __("Fill in your details to create your job seeker profile.") }}
            </p>
        </header>

        <form method="post" action="{{ route('profile.store') }}" class="mt-6 space-y-6 card" enctype="multipart/form-data">
            @csrf

            <!-- Full Name -->
            <div>
                <x-input-label for="fullName" :value="__('Full Name')" />
                <x-text-input id="fullName" name="fullName" type="text" class="mt-1 block w-full" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('fullName')" />
            </div>

            <!-- Contact Information -->
            <div>
                <x-input-label for="contact_information" :value="__('Contact Information')" />
                <x-text-input id="contact_information" name="contact_information" type="text" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('contact_information')" />
            </div>

            <!-- Resume -->
            <div>
                <x-input-label for="resume" :value="__('Resume (PDF, DOC, DOCX)')" />
                <x-text-input id="resume" name="resume" type="file" class="mt-1 block w-full form-control" />
                <x-input-error class="mt-2" :messages="$errors->get('resume')" />
            </div>

            <!-- Education -->
            <div>
                <x-input-label for="education" :value="__('Education')" />
                <textarea id="education" name="education" class="mt-1 block w-full form-control"></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('education')" />
            </div>

            <!-- Competences -->
            <div>
                <x-input-label for="competences" :value="__('Competences')" />
                <textarea id="competences" name="competences" class="mt-1 block w-full form-control"></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('competences')" />
            </div>

            <!-- Experience -->
            <div>
                <x-input-label for="experience" :value="__('Experience')" />
                <textarea id="experience" name="experience" class="mt-1 block w-full form-control"></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('experience')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
            </div>
        </form>
    </section>
</div>