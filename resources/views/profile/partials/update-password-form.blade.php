<section>
    <header class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
            <i class="bi bi-shield-lock-fill text-[#a31b1b]"></i>
            {{ __('Update Password') }}
        </h2>
        <p class="mt-2 text-sm text-gray-500 font-medium">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label for="update_password_current_password" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Current Password') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="bi bi-key text-gray-400"></i>
                </div>
                <input id="update_password_current_password" name="current_password" type="password" required autocomplete="current-password"
                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] transition-colors font-medium" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- New Password -->
        <div>
            <label for="update_password_password" class="block text-sm font-bold text-gray-700 mb-2">{{ __('New Password') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="bi bi-key-fill text-gray-400"></i>
                </div>
                <input id="update_password_password" name="password" type="password" required autocomplete="new-password"
                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] transition-colors font-medium" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Confirm Password') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="bi bi-check-circle text-gray-400"></i>
                </div>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] transition-colors font-medium" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-gray-900 hover:bg-black text-white font-bold py-3 px-8 rounded-xl transition-all shadow-sm flex items-center gap-2">
                <i class="bi bi-lock"></i> {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm font-bold text-green-600 flex items-center gap-1.5 bg-green-50 px-3 py-1.5 rounded-lg border border-green-100">
                    <i class="bi bi-check-circle-fill"></i> {{ __('Saved successfully.') }}
                </p>
            @endif
        </div>
    </form>
</section>
