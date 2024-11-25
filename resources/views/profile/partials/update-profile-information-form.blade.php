<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('incs.alert')
    
        
        {{-- <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div> --}}



        <!-- Full Name -->
        <div>
            <x-input-label for="fullName" :value="__('Full Name')" />
            <x-text-input id="fullName" name="fullName"  type="text" class="mt-1 block w-full" 
                :value="old('fullName', $profile->fullName ?? '')" required autofocus autocomplete="fullName" />
            <x-input-error class="mt-2" :messages="$errors->get('fullName')" />
        </div>

        <!-- Contact Information -->
        <div>
            <x-input-label for="contact_information" :value="__('Contact Information')" />
            <x-text-input id="contact_information" name="contact_information" type="text" class="mt-1 block w-full" 
                :value="old('contact_information', $profile->contact_information ?? '')" required autocomplete="contact-information" />
            <x-input-error class="mt-2" :messages="$errors->get('contact_information')" />
        </div>

        <!-- Other Fields -->
        <div>
            <x-input-label for="resume" :value="__('Resume')" />
            <x-text-input id="resume" name="resume" type="file" class="form-control mt-1 block w-full form-iput" 
                :value="old('resume', $profile->resume ?? '')" autocomplete="resume" />
            <x-input-error class="mt-2" :messages="$errors->get('resume')" />
        </div>

        <div>
            <x-input-label for="competences" :value="__('Competences')" />
            <x-text-input id="competences" name="competences" class="mt-1 block w-full" :value="old('competences', $profile->competences ?? '')"></x-text-input>
            <x-input-error class="mt-2" :messages="$errors->get('competences')" />
        </div>

        <div>
            <x-input-label for="experience" :value="__('Experience')" />
            <textarea id="experience" name="experience" class="form-control mt-1 block w-full">{{ old('experience', $profile->experience ?? '') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('experience')" />
        </div>

        <div>
            <x-input-label for="education" :value="__('Education')" />
            <textarea id="education" name="education" class="mt-1 block w-full form-control">{{ old('education', $profile->education ?? '') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('education')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
