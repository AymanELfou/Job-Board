<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Company Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's company profile information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('employer.profile.update') }}" class="mt-6 space-y-6">
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
            <x-input-label for="Company Name" :value="__('Company Name')" />
            <x-text-input id="fullName" name="nom_entreprise"  type="text" class="mt-1 block w-full" 
                :value="old('nom_entreprise', $profile->nom_entreprise ?? '')" required autofocus autocomplete="nom_entreprise" />
            <x-input-error class="mt-2" :messages="$errors->get('nom_entreprise')" />
        </div>

        <!-- Contact Information -->
        <div>
            <x-input-label for="Phone Number" :value="__('Phone Number')" />
            <x-text-input id="telephone" name="telephone" type="text" class="mt-1 block w-full" 
                :value="old('telephone', $profile->telephone ?? '')" required autocomplete="telephone" />
            <x-input-error class="mt-2" :messages="$errors->get('telephone')" />
        </div>

        <!-- Other Fields -->
        <div>
            <x-input-label for="Adresse" :value="__('Adresse')" />
            <x-text-input id="adresse" name="adresse" type="text" class="form-control mt-1 block w-full form-iput" 
                 autocomplete="adresse" :value="old('adresse', $profile->adresse ?? '')"/>
            <x-input-error class="mt-2" :messages="$errors->get('Adresse')" />
        </div>

        <div>
            <x-input-label for="Sector of Activity" :value="__('Sector of Activity')" />
            <x-text-input id="Sector of Activity" name="secteur_activite" class="mt-1 block w-full" :value="old('secteur_activite', $profile->secteur_activite ?? '')"></x-text-input>
            
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="Description" name="description" class="form-control mt-1 block w-full">{{ old('description', $profile->description ?? '') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
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