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
                    Set a New <span class="text-red-200">Password</span>
                </h1>
                <p class="text-xl text-red-50/80 leading-relaxed font-light">
                    You're almost there! Create a strong and secure password for your JobBoard account.
                </p>
                
                <div class="mt-12 flex justify-center space-x-4 opacity-50">
                    <div class="w-3 h-3 rounded-full bg-white/30"></div>
                    <div class="w-3 h-3 rounded-full bg-white/30"></div>
                    <div class="w-3 h-3 rounded-full bg-white"></div>
                </div>
            </div>
            
            <div class="absolute bottom-8 left-8 text-sm text-red-100/50">
                &copy; {{ date('Y') }} JobBoard Platform. All rights reserved.
            </div>
        </div>

        <!-- Form Section (Right side on desktop) -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-6 sm:p-12 bg-gray-50/50 overflow-y-auto h-screen">
            <div class="w-full max-w-md my-auto pb-10">
                <!-- Mobile Header -->
                <div class="md:hidden text-center mb-8">
                    <div class="inline-flex items-center justify-center mb-4">
                        <img src="{{ asset('imgs/empj.png') }}" alt="JobBoard Logo" class="h-12 w-auto" />
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Reset Password</h2>
                </div>

                <div class="bg-white p-8 sm:p-10 rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-gray-100">
                    <div class="mb-8 hidden md:block">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Create New Password</h2>
                        <p class="text-gray-500 text-sm">Please secure your account with a strong password.</p>
                    </div>

                    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-1 py-1 flex items-center pointer-events-none transition-colors group-focus-within:text-[#a31b1b] text-gray-400">
                                    <svg class="h-5 w-5 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input id="email" 
                                       type="email" 
                                       name="email" 
                                       value="{{ old('email', $request->email) }}" 
                                       required 
                                       autofocus 
                                       autocomplete="username"
                                       class="block w-full pl-12 pr-4 py-3 bg-gray-50 border-gray-200 border rounded-xl focus:ring-2 focus:ring-[#a31b1b]/20 focus:border-[#a31b1b] transition-all outline-none text-gray-900 placeholder-gray-400 sm:text-sm"
                                       placeholder="name@example.com" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-1 py-1 flex items-center pointer-events-none transition-colors group-focus-within:text-[#a31b1b] text-gray-400">
                                    <svg class="h-5 w-5 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input id="password" 
                                       type="password" 
                                       name="password" 
                                       required 
                                       autocomplete="new-password"
                                       class="block w-full pl-12 pr-4 py-3 bg-gray-50 border-gray-200 border rounded-xl focus:ring-2 focus:ring-[#a31b1b]/20 focus:border-[#a31b1b] transition-all outline-none text-gray-900 placeholder-gray-400 sm:text-sm"
                                       placeholder="••••••••" />
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-1 py-1 flex items-center pointer-events-none transition-colors group-focus-within:text-[#a31b1b] text-gray-400">
                                    <svg class="h-5 w-5 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <input id="password_confirmation" 
                                       type="password" 
                                       name="password_confirmation" 
                                       required 
                                       autocomplete="new-password"
                                       class="block w-full pl-12 pr-4 py-3 bg-gray-50 border-gray-200 border rounded-xl focus:ring-2 focus:ring-[#a31b1b]/20 focus:border-[#a31b1b] transition-all outline-none text-gray-900 placeholder-gray-400 sm:text-sm"
                                       placeholder="••••••••" />
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-[#a31b1b] hover:bg-[#8b1616] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#a31b1b] transition-all transform hover:-translate-y-0.5 active:translate-y-0 tracking-widest uppercase">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
