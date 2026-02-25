<x-guest-layout>
    <div class="fixed inset-0 flex flex-col md:flex-row overflow-hidden bg-white">
        <!-- Brand Section (Left side on desktop) -->
        <div class="hidden md:flex md:w-1/2 bg-[#a31b1b] relative items-center justify-center p-12 text-white">
            <!-- Decorative Elements -->
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                <div class="absolute -top-24 -left-24 w-96 h-96 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 right-10 w-64 h-64 bg-black rounded-full blur-3xl"></div>
            </div>

            <div class="relative z-10 text-center max-w-lg">
                <div class="mb-10 inline-block p-4 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 shadow-2xl">
                    <img src="{{ asset('imgs/empj.png') }}" alt="JobBoard Logo" class="h-20 w-auto brightness-0 invert" />
                </div>
                <h1 class="text-5xl font-extrabold mb-6 tracking-tight leading-tight">
                    Start Your <span class="text-red-200">Professional</span> Path.
                </h1>
                <p class="text-xl text-red-50/80 leading-relaxed font-light">
                    Create your account today and unlock access to premium job opportunities or find the best talent for your company.
                </p>
                
                <div class="mt-12 flex justify-center space-x-4 opacity-50">
                    <div class="w-3 h-3 rounded-full bg-white/30"></div>
                    <div class="w-3 h-3 rounded-full bg-white"></div>
                    <div class="w-3 h-3 rounded-full bg-white/30"></div>
                </div>
            </div>
            
            <div class="absolute bottom-8 left-8 text-sm text-red-100/50">
                &copy; {{ date('Y') }} JobBoard Platform. All rights reserved.
            </div>
        </div>

        <!-- Form Section (Right side on desktop) - Using overflow-y-auto for longer registration forms -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-6 sm:p-12 bg-gray-50/50 overflow-y-auto">
            <div class="w-full max-w-md my-auto">
                <!-- Mobile Header -->
                <div class="md:hidden text-center mb-8">
                    <div class="inline-flex items-center justify-center mb-4">
                        <img src="{{ asset('imgs/empj.png') }}" alt="JobBoard Logo" class="h-12 w-auto" />
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Create Account</h2>
                </div>

                <div class="bg-white p-8 sm:p-10 rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-gray-100">
                    <div class="mb-8 hidden md:block">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Register</h2>
                        <p class="text-gray-500">Join our community and grow your future</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">Full Name</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-1 py-1 flex items-center pointer-events-none transition-colors group-focus-within:text-[#a31b1b] text-gray-400">
                                    <svg class="h-5 w-5 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input id="name" 
                                       type="text" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required 
                                       autofocus 
                                       autocomplete="name"
                                       class="block w-full pl-12 pr-4 py-3 bg-gray-50 border-gray-200 border rounded-xl focus:ring-2 focus:ring-[#a31b1b]/20 focus:border-[#a31b1b] transition-all outline-none text-gray-900 placeholder-gray-400 sm:text-sm"
                                       placeholder="John Doe" />
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-1 py-1 flex items-center pointer-events-none transition-colors group-focus-within:text-[#a31b1b] text-gray-400">
                                    <svg class="h-5 w-5 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input id="email" 
                                       type="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       autocomplete="username"
                                       class="block w-full pl-12 pr-4 py-3 bg-gray-50 border-gray-200 border rounded-xl focus:ring-2 focus:ring-[#a31b1b]/20 focus:border-[#a31b1b] transition-all outline-none text-gray-900 placeholder-gray-400 sm:text-sm"
                                       placeholder="name@example.com" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <!-- Password -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                                <input id="password" 
                                       type="password" 
                                       name="password" 
                                       required 
                                       autocomplete="new-password"
                                       class="block w-full px-4 py-3 bg-gray-50 border-gray-200 border rounded-xl focus:ring-2 focus:ring-[#a31b1b]/20 focus:border-[#a31b1b] transition-all outline-none text-gray-900 placeholder-gray-400 sm:text-sm"
                                       placeholder="••••••••" />
                                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">Confirm</label>
                                <input id="password_confirmation" 
                                       type="password" 
                                       name="password_confirmation" 
                                       required 
                                       autocomplete="new-password"
                                       class="block w-full px-4 py-3 bg-gray-50 border-gray-200 border rounded-xl focus:ring-2 focus:ring-[#a31b1b]/20 focus:border-[#a31b1b] transition-all outline-none text-gray-900 placeholder-gray-400 sm:text-sm"
                                       placeholder="••••••••" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                            </div>
                        </div>

                        <!-- Role Selection -->
                        <div>
                            <label for="role" class="block text-sm font-semibold text-gray-700 mb-1.5">Register As</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-1 py-1 flex items-center pointer-events-none transition-colors group-focus-within:text-[#a31b1b] text-gray-400">
                                    <svg class="h-5 w-5 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <select name="role" id="role" required class="block w-full pl-12 pr-10 py-3 bg-gray-50 border-gray-200 border rounded-xl focus:ring-2 focus:ring-[#a31b1b]/20 focus:border-[#a31b1b] transition-all outline-none text-gray-900 appearance-none sm:text-sm">
                                    <option value="admin">Admin</option>
                                    <option value="employer">Employer</option>
                                    <option value="Job Seeker">Job Seeker</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400 group-focus-within:text-[#a31b1b]">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-[#a31b1b] hover:bg-[#8b1616] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#a31b1b] transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                                CREATE MY ACCOUNT
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 text-center text-sm text-gray-500">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-bold text-[#a31b1b] hover:text-[#8b1616] transition-colors">Sign in here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
