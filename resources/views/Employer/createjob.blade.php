<x-apps.app-employer>

    <x-slot name="header">
        <div class="flex items-center justify-center h-screen">
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                {{ __('Create job') }}
            </h2>
        </div>
    </x-slot>


            <!-- Form for creating a new job -->
    <div class="container mx-auto p-6">
        <form action="{{ route('employer.jobs.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <!-- Hidden field for employer ID -->
            <input type="hidden" name="id_employeur" value="{{ auth()->user()->id }}"/>
    
            <!-- Input for job title -->
            <div>
                <x-input-label  for="titre" class="m-2 h5"  :value="__('Job title')"/>
                {{-- <label for="titre" class="block text-sm font-medium text-gray-700">Titre du Job</label> --}}
                <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm  focus:ring focus:ring-blue-500" id="titre" name="titre" required> 
                
            </div>

            <div>
                <label for="company" class="block text-sm font-medium text-gray-700 m-2 h5">Company</label><!-- Label for company name -->
                <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="company" name="company" required>
            </div>

            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 m-2 h5">Location</label><!-- Label for Localisation -->
                <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="location" name="location" required><!-- Input for job location -->
            </div>
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 m-2 h5">Type</label> <!-- Label for job type -->
                <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="type" name="job_type" required> <!-- Input for job type -->
            </div>
            
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 m-2 h5">Category</label> <!-- Label for job category -->
                <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="category" name="categorie" required> <!-- Input for job category -->
            </div>
            
            <div>
                <label for="salaire" class="block text-sm font-medium text-gray-700 m-2 h5">Salaire</label> <!-- Label for salary -->
                <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="salaire" name="salaire" required> <!-- Input for salary -->
            </div>
            
            <div>
                <label for="type_contrat" class="block text-sm font-medium text-gray-700 m-2 h5">Type Contrat</label> <!-- Label for contract type -->
                <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="type_contrat" name="type_contrat" required> <!-- Input for contract type -->
            </div>
            
            <div>
                <label for="date_publication" class="block text-sm font-medium text-gray-700 m-2 h5">Date publication</label> <!-- Label for publication date -->
                <input type="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="date_publication" name="date_publication" required> <!-- Input for publication date -->
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 m-2 h5">Description</label> <!-- Label for job description -->
                <textarea class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="description" name="description" rows="4" required></textarea> <!-- Textarea for job description -->
            </div>
            
            <button type="submit" class="btn btn-danger mt-4 text-3xl bg-blue-500 leading-tight text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 transition duration-200">Save Job</button> <!-- Submit button for the form -->
            
        </form>
    </div>
</x-apps.app-employer>




