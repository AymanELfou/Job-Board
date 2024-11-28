<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-start h-screen">
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                {{ __('Edit Job Seeker') }}
            </h2>
        </div>
    </x-slot>

    <!-- Form for updating a job seeker -->
    <div class="container mx-auto p-6">
        <form action="{{ route('jobseeker.update', $Jobseeker->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Hidden field for employer ID -->
            <input type="hidden" name="id_utilisateur" value="{{ auth()->user()->id }}"/>

            <!-- Input for full name -->
            <div>
                <label for="fullName" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" class="mt-1 mb-2 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="fullName" name="fullName" value="{{ old('fullName', $Jobseeker->fullName) }}">
            </div>

            <!-- Input for contact information -->
            <div>
                <label for="contact_information" class="mt-1 block text-sm font-medium text-gray-700">Contact Information</label>
                <input type="text" class="mt-1 mb-2 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="contact_information" name="contact_information" value="{{ $Jobseeker->contact_information }}">
            </div>

            <!-- Input for competences -->
            <div>
                <label for="competences" class="block text-sm font-medium text-gray-700">Competences</label>
                <input type="text" class="mt-1 mb-2 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="competences" name="competences" value="{{ old('competences', $Jobseeker->competences) }}">
            </div>

            <!-- Input for education -->
            <div>
                <label for="education" class="block text-sm font-medium text-gray-700">Education</label>
                <input type="text" class="mt-1 mb-2 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="education" name="education" value="{{ old('education', $Jobseeker->education) }}">
            </div>

            <!-- Input for experience -->
            <div>
                <label for="experience" class="block text-sm font-medium text-gray-700">Experience</label>
                <input type="text" class="mt-1 mb-2 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="experience" name="experience" value="{{ old('experience', $Jobseeker->experience) }}">
            </div>

            <!-- Input for resume upload -->
            <div>
                <label for="resume" class="block text-sm font-medium text-gray-700">Resume</label>
                <input type="file" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="resume" name="resume" value="{{ $Jobseeker->resume }}" accept=".pdf">
               {{--  @if ($Jobseeker->resume)
                    <p class="text-sm text-gray-600 mt-2">Current resume: <a href="{{ asset('storage/' . $Jobseeker->resume) }}" target="_blank" class="text-blue-500 underline">View Resume</a></p>
                @endif --}}
            </div>

            <button type="submit" class="btn btn-primary mt-4 text-3xl bg-blue-500 leading-tight text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 transition duration-200">
                Update
            </button>
        </form>
    </div>
</x-app-layout>
