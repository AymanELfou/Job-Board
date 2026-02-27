<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'JobBoard') }} - Create Profile</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50/50 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-2xl bg-white rounded-[2rem] shadow-xl border border-gray-100 overflow-hidden my-8">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 pt-10 pb-8 px-8 md:px-12 text-center relative overflow-hidden">
            <!-- Decorative circle -->
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/5 rounded-full blur-2xl"></div>
            <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-[#a31b1b]/20 rounded-full blur-2xl"></div>
            
            <div class="relative z-10">
                <div class="w-16 h-16 bg-[#a31b1b] rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-[#a31b1b]/30">
                    <i class="bi bi-person-badge text-white text-3xl"></i>
                </div>
                <h1 class="text-3xl font-extrabold text-white tracking-tight mb-2">
                    Create Your <span class="text-[#a31b1b]">Profile</span>
                </h1>
                <p class="text-gray-300 font-medium">
                    Complete your profile to start applying for jobs and get noticed by top employers.
                </p>
            </div>
        </div>

        <!-- Form -->
        <div class="p-8 md:p-12">
            <form method="post" action="{{ route('profile.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Full Name & Contact Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="fullName" class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="bi bi-person text-gray-400"></i>
                            </div>
                            <input id="fullName" name="fullName" type="text" required autofocus value="{{ old('fullName') }}"
                                class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] transition-colors font-medium">
                        </div>
                        <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('fullName')" />
                    </div>

                    <div>
                        <label for="contact_information" class="block text-sm font-bold text-gray-700 mb-2">Contact Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="bi bi-telephone text-gray-400"></i>
                            </div>
                            <input id="contact_information" name="contact_information" type="text" required value="{{ old('contact_information') }}" placeholder="+1 234 567 8900"
                                class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] transition-colors font-medium">
                        </div>
                        <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('contact_information')" />
                    </div>
                </div>

                <!-- Resume -->
                <div>
                    <label for="resume" class="block text-sm font-bold text-gray-700 mb-2">Upload Resume</label>
                    <div class="mt-1 flex justify-center px-6 pt-6 pb-8 border-2 border-gray-200 border-dashed rounded-xl hover:border-[#a31b1b] transition-colors bg-gray-50 group cursor-pointer relative">
                        <input id="resume" name="resume" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" required accept=".pdf,.doc,.docx">
                        <div class="space-y-2 text-center flex flex-col items-center">
                            <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-sm text-gray-400 group-hover:text-[#a31b1b] transition-colors mb-2">
                                <i class="bi bi-cloud-arrow-up text-2xl"></i>
                            </div>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <span class="relative bg-white rounded-md font-bold text-[#a31b1b] group-hover:text-[#8a1717]">
                                    Browse files
                                </span>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-widest">PDF, DOC, DOCX up to 5MB</p>
                        </div>
                    </div>
                    <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('resume')" />
                </div>

                <!-- Education -->
                <div>
                    <label for="education" class="block text-sm font-bold text-gray-700 mb-2">Education</label>
                    <textarea id="education" name="education" rows="3" placeholder="List your relevant educational background..."
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-4 transition-colors font-medium">{{ old('education') }}</textarea>
                    <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('education')" />
                </div>

                <!-- Competences Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="competences" class="block text-sm font-bold text-gray-700 mb-2">Key Skills</label>
                        <textarea id="competences" name="competences" rows="4" placeholder="Programming languages, tools, soft skills..."
                            class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-4 transition-colors font-medium">{{ old('competences') }}</textarea>
                        <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('competences')" />
                    </div>

                    <!-- Experience -->
                    <div>
                        <label for="experience" class="block text-sm font-bold text-gray-700 mb-2">Professional Experience</label>
                        <textarea id="experience" name="experience" rows="4" placeholder="Briefly describe your previous work experience..."
                            class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-4 transition-colors font-medium">{{ old('experience') }}</textarea>
                        <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('experience')" />
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6 border-t border-gray-100">
                    <button type="submit" class="w-full bg-[#a31b1b] hover:bg-[#8a1717] text-white font-bold py-4 px-8 rounded-xl transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 text-lg">
                        <i class="bi bi-person-check-fill text-xl"></i> Complete Profile Setup
                    </button>
                    <p class="text-xs text-center text-gray-400 mt-4 font-medium uppercase tracking-wider">
                        By submitting, you agree to our terms of service
                    </p>
                </div>

            </form>
        </div>
    </div>

</body>
</html>