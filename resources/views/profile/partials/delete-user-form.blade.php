<section class="space-y-6">
    <header class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
            <i class="bi bi-exclamation-triangle-fill text-red-500 bg-red-50 p-2 rounded-xl"></i>
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-2 text-sm text-gray-500 font-medium">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-white border-2 border-red-200 hover:bg-red-50 text-red-600 font-bold py-3 px-8 rounded-xl transition-all shadow-sm flex items-center gap-2"
    >
        <i class="bi bi-trash"></i> {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                    <i class="bi bi-exclamation-triangle-fill text-xl text-red-500"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>
            </div>

            <p class="mb-6 text-sm text-gray-600 font-medium bg-red-50/50 p-4 rounded-xl border border-red-100">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="bi bi-key text-gray-400"></i>
                    </div>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-red-500 focus:border-red-500 transition-colors font-medium"
                        placeholder="{{ __('Confirm Password') }}"
                    />
                </div>
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-sm text-red-600" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold py-2.5 px-6 rounded-xl transition-colors">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2.5 px-6 rounded-xl transition-all shadow-sm flex items-center gap-2">
                    <i class="bi bi-trash"></i> {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
