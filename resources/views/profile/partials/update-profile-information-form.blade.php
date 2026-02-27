<section>
    <header class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
            <i class="bi bi-person-lines-fill text-[#a31b1b]"></i>
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-2 text-sm text-gray-500 font-medium">
            {{ __("Update your account's profile information, contact details, and resume.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('incs.alert')

        <!-- Full Name -->
        <div>
            <label for="fullName" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Full Name') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="bi bi-person text-gray-400"></i>
                </div>
                <input id="fullName" name="fullName" type="text" required autofocus
                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] transition-colors font-medium"
                    value="{{ old('fullName', $profile->fullName ?? '') }}" autocomplete="fullName" />
            </div>
            <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('fullName')" />
        </div>

        <!-- Contact Information -->
        <div>
            <label for="contact_information" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Contact Information') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="bi bi-telephone text-gray-400"></i>
                </div>
                <input id="contact_information" name="contact_information" type="text" required
                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] transition-colors font-medium"
                    value="{{ old('contact_information', $profile->contact_information ?? '') }}" autocomplete="contact-information" />
            </div>
            <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('contact_information')" />
        </div>

        <!-- Resume -->
        <div>
            <label for="resume" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Resume (PDF, DOCX)') }}</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-200 border-dashed rounded-xl hover:border-[#a31b1b] transition-colors bg-gray-50 group relative">
                <input id="resume" name="resume" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept=".pdf,.doc,.docx">
                <div class="space-y-1 text-center">
                    <i class="bi bi-cloud-arrow-up text-3xl text-gray-400 group-hover:text-[#a31b1b] transition-colors mb-2 block"></i>
                    <div class="flex text-sm text-gray-600 justify-center">
                        <span class="relative bg-transparent font-bold text-[#a31b1b] group-hover:text-[#8a1717]">
                            Upload a new file
                        </span>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    @if($profile->resume ?? false)
                        <p class="text-xs text-green-600 font-bold mt-2"><i class="bi bi-check-circle-fill"></i> Resume currently uploaded</p>
                    @endif
                </div>
            </div>
            <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('resume')" />
        </div>

        <!-- Competences -->
        <div>
            <label for="competences" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Key Skills') }}</label>
            <textarea id="competences" name="competences" rows="3"
                class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-4 transition-colors font-medium"
                placeholder="List your programming languages, tools, and soft skills...">{{ old('competences', $profile->competences ?? '') }}</textarea>
            <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('competences')" />
        </div>

        <!-- Experience -->
        <div>
            <label for="experience" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Professional Experience') }}</label>
            <textarea id="experience" name="experience" rows="3"
                class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-4 transition-colors font-medium"
                placeholder="Briefly describe your previous work history...">{{ old('experience', $profile->experience ?? '') }}</textarea>
            <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('experience')" />
        </div>

        <!-- Education -->
        <div>
            <label for="education" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Education') }}</label>
            <textarea id="education" name="education" rows="3"
                class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-[#a31b1b] focus:border-[#a31b1b] p-4 transition-colors font-medium"
                placeholder="List your relevant educational background...">{{ old('education', $profile->education ?? '') }}</textarea>
            <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('education')" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-[#a31b1b] hover:bg-[#8a1717] text-white font-bold py-3 px-8 rounded-xl transition-all shadow-sm flex items-center gap-2">
                <i class="bi bi-save"></i> {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated' || session('success'))
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm font-bold text-green-600 flex items-center gap-1.5 bg-green-50 px-3 py-1.5 rounded-lg border border-green-100">
                    <i class="bi bi-check-circle-fill"></i> {{ __('Saved successfully.') }}
                </p>
            @endif
        </div>
    </form>
</section>
