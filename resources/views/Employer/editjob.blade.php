<x-apps.app-employer>


    <x-slot name="header">
        <div class="flex items-center justify-center h-screen">
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight "style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                {{ __('Edit job') }}
            </h2>
        </div>
    </x-slot>





    <div class="container my-5">
        <form action="{{ route('employer.jobs.update', $job->id) }}" method="POST" class="mb-4">
            @csrf
            @method("PUT")
    
    
            <div class="mb-3">
                <x-input-label  for="titre"  :value="__('Job Title')"/>
                <input type="text" class="form-control" id="titre" name="titre" value="{{ $job->titre }}" required>
            </div>
            
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ $job->location }}" required>
            </div>
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 m-2 mt-2">Type</label> <!-- Label for job type -->
                <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500 form-select" id="type" name="job_type" required> <!-- Dropdown for job type -->
                    <option value="" disabled selected>Select job type</option> <!-- Placeholder option -->
                    <option value="full_time">Full Time</option> <!-- Full Time option -->
                    <option value="part_time">Part Time</option> <!-- Part Time option -->
                </select>
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 m-2 mt-2">Category</label> <!-- Label for job category -->
                <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="category" name="categorie" required> <!-- Dropdown for job category -->
                    <option value="" disabled selected>Select category</option> <!-- Placeholder option -->
                    <option value="tech">Tech</option> <!-- Tech option -->
                    <option value="sells">Sells</option> <!-- Sells option -->
                    <option value="marketing">Marketing</option> <!-- Marketing option -->
                    <option value="finance">Finance</option> <!-- Finance option -->
                    <option value="education">Education</option> <!-- Education option -->
                </select>
            </div>

            <div class="mb-3">
                <label for="salaire" class="form-label">Salaire</label>
                <input type="text" class="form-control" id="salaire" name="salaire" value="{{ $job->salaire }}" required>
            </div>

            <div>
                <label for="type_contrat" class="block text-sm font-medium text-gray-700 m-2 mt-2">Type Contrat</label> <!-- Label for contract type -->
                <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="type_contrat" name="type_contrat" required> <!-- Dropdown for contract type -->
                    <option value="" disabled selected>Select contract type</option> <!-- Placeholder option -->
                    <option value="cdd">CDD (Contrat à Durée Déterminée)</option> <!-- CDD option -->
                    <option value="cdi">CDI (Contrat à Durée Indéterminée)</option> <!-- CDI option -->
                </select>
            </div>

            <div class="mb-3">
                <label for="date_publication" class="form-label">Date publication</label>
                <input type="date" class="form-control" id="date_publication" name="date_publication" value="{{ $job->date_publication }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ $job->description }}</textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
    


</x-apps.app-employer>


