<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-start h-screen">
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                {{ __('Create Job Seeker') }}
            </h2>
        </div>
    </x-slot>


            <!-- Form for creating a new job -->
    <div class="container mx-auto p-6">
        <form action="{{ route('jobseeker.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf
            
            <!-- Hidden field for employer ID -->
            <input type="hidden" name="id_utilisateur" value="{{ auth()->user()->id }}"/>
    
            <!-- Input for job title -->
            <div>
                {{-- <x-input-label  for="Full Name"  :value="__('Full Name')"/> --}}
                <label for="fullName" class="block text-sm font-medium text-gray-700">Full Name</label>
                {{-- <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="titre" name="titre" required> --}}
                <input type="text" class="mt-1 mb-2 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="fullName" name="fullName" required>
            </div>

            <div>
                <label for="Contact Information" class="mt-1 block text-sm font-medium text-gray-700">Contact Information</label><!-- Label for Contact Information -->
                <input type="text" class="mt-1 mb-2 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="Contact Information" name="contact_information" required>
            </div>

            <div>
                <label for="skills" class="block text-sm font-medium text-gray-700">Skills</label><!-- Label for Skills -->
                <input type="text" class="mt-1 mb-2 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="skills" name="competences" required><!-- Input for competences -->
            </div>

            <div>
                <label for="education" class="block text-sm font-medium text-gray-700">Education</label> <!-- Label for education -->
                <input type="text" class="mt-1 mb-2 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="education" name="education" required> <!-- Input for education -->
            </div>
            
            <div>
                <label for="experience" class="block text-sm font-medium text-gray-700">Experience</label> <!-- Label for job experience -->
                <input type="text" class="mt-1 mb-2 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="experience" name="experience" required> <!-- Input for experience -->
            </div>
            
            <div>
                <label for="resume" class="block text-sm font-medium text-gray-700">Resume</label> <!-- Label for salary -->
                <input type="file" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="resume" name="resume" accept=".pdf" required> <!-- Input for resume -->
            </div>
            
            
            <b><button type="submit" class="btn btn-primary mt-4 text-3xl bg-blue-500 leading-tight text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 transition duration-200">Create</button></b> <!-- Submit button for the form -->
            
        </form>
    </div>
</x-app-layout>




