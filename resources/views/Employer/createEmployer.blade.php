<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Create Profile</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50 flex items-center justify-center min-h-screen p-4 sm:p-6 lg:p-8">

    <div class="max-w-3xl w-full">
        <!-- Header Section -->
        <div class="text-center mb-10">
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-gray-900 mb-4">
                Create Your <span class="text-[#a31b1b]">Company Profile</span>
            </h1>
            <p class="text-lg text-gray-500 font-medium">
                Fill in your details to get started with recruiting on our platform.
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 sm:p-12">
                <form method="post" action="{{ route('employer.profile.store') }}" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Company Name -->
                        <div class="md:col-span-2">
                            <label for="nom_entreprise" class="block text-sm font-bold text-gray-700 mb-2">Company Name <span class="text-[#a31b1b]">*</span></label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <i class="bi bi-building"></i>
                                </span>
                                <input id="nom_entreprise" name="nom_entreprise" type="text" value="{{ old('nom_entreprise') }}" required autofocus
                                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] transition-colors duration-200 font-medium"
                                    placeholder="e.g. Acme Corporation" />
                            </div>
                            <x-input-error class="mt-2 text-[#a31b1b] font-medium text-sm" :messages="$errors->get('nom_entreprise')" />
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="adresse" class="block text-sm font-bold text-gray-700 mb-2">Address <span class="text-[#a31b1b]">*</span></label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </span>
                                <input id="adresse" name="adresse" type="text" value="{{ old('adresse') }}" required
                                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] transition-colors duration-200 font-medium"
                                    placeholder="e.g. 123 Tech Avenue, NY" />
                            </div>
                            <x-input-error class="mt-2 text-[#a31b1b] font-medium text-sm" :messages="$errors->get('adresse')" />
                        </div>

                        <!-- industry / Secteur Activite -->
                        <div>
                            <label for="secteur_activite" class="block text-sm font-bold text-gray-700 mb-2">Industry Sector</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <i class="bi bi-briefcase-fill"></i>
                                </span>
                                <input id="secteur_activite" name="secteur_activite" type="text" value="{{ old('secteur_activite') }}"
                                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] transition-colors duration-200 font-medium"
                                    placeholder="e.g. Information Technology" />
                            </div>
                            <x-input-error class="mt-2 text-[#a31b1b] font-medium text-sm" :messages="$errors->get('secteur_activite')" />
                        </div>

                        <!-- Phone Number -->
                        <div class="md:col-span-2">
                            <label for="telephone" class="block text-sm font-bold text-gray-700 mb-2">Phone Number</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <i class="bi bi-telephone-fill"></i>
                                </span>
                                <input id="telephone" name="telephone" type="tel" value="{{ old('telephone') }}"
                                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] transition-colors duration-200 font-medium"
                                    placeholder="e.g. +1 234 567 8900" />
                            </div>
                            <x-input-error class="mt-2 text-[#a31b1b] font-medium text-sm" :messages="$errors->get('telephone')" />
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="competences" class="block text-sm font-bold text-gray-700 mb-2">Company Description</label>
                            <div class="relative">
                                <textarea id="Description" name="competences" rows="5"
                                    class="w-full p-4 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] transition-colors duration-200 font-medium resize-y"
                                    placeholder="Tell candidates about your company's mission, culture, and what makes it a great place to work...">{{ old('competences') }}</textarea>
                            </div>
                            <x-input-error class="mt-2 text-[#a31b1b] font-medium text-sm" :messages="$errors->get('competences')" />
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex items-center justify-end">
                        <button type="submit" class="inline-flex items-center justify-center gap-2 bg-[#a31b1b] hover:bg-[#8a1717] text-white px-8 py-4 rounded-xl font-bold transition-all duration-300 shadow-sm hover:shadow-md w-full sm:w-auto text-lg">
                            <i class="bi bi-check-circle-fill"></i>
                            Save Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Footer simple note -->
        <p class="text-center text-gray-400 text-sm mt-8 font-medium">
            You can always update this information later from your dashboard.
        </p>
    </div>

</body>
</html>