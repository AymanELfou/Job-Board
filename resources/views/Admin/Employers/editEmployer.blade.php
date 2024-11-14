<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-start h-screen">
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                {{ __('Edit Employer') }}
            </h2>
        </div>
    </x-slot>

    <!-- Form for updating an employer -->
    <div class="container mx-auto p-6">
        <form action="{{ route('employers.update', $Employer->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Hidden field for user ID -->
            <input type="hidden" name="id_utilisateur" value="{{ auth()->user()->id }}"/>

            <!-- Input for company name -->
            <div>
                <label for="nom_entreprise" class="block text-sm font-medium text-gray-700">Company Name</label>
                <input type="text" class="mt-1 mb-2 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="nom_entreprise" name="nom_entreprise" value="{{ old('nom_entreprise', $Employer->nom_entreprise) }}" required>
            </div>

            <!-- Input for address -->
            <div>
                <label for="adresse" class="mt-1 block text-sm font-medium text-gray-700">Address</label>
                <input type="text" class="mt-1 mb-2 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="adresse" name="adresse" value="{{ old('adresse', $Employer->adresse) }}" required>
            </div>

            <!-- Input for description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea class="mt-1 mb-2 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="description" name="description">{{ old('description', $Employer->description) }}</textarea>
            </div>

            <!-- Input for phone -->
            <div>
                <label for="telephone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" class="mt-1 mb-2 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="telephone" name="telephone" value="{{ old('telephone', $Employer->telephone) }}">
            </div>

            <!-- Input for sector of activity -->
            <div>
                <label for="secteur_activite" class="block text-sm font-medium text-gray-700">Sector of Activity</label>
                <input type="text" class="mt-1 mb-2 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="secteur_activite" name="secteur_activite" value="{{ old('secteur_activite', $Employer->secteur_activite) }}">
            </div>

            <button type="submit" class="btn btn-primary mt-4 text-3xl bg-blue-500 leading-tight text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 transition duration-200">
                Update
            </button>
        </form>
    </div>
</x-app-layout>
