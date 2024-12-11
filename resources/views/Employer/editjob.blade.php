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
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <input type="text" class="form-control" id="type" name="job_type" value="{{ $job->job_type }}" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Catégorie</label>
                <input type="text" class="form-control" id="category" name="categorie" value="{{ $job->categorie }}" required>
            </div>
            <div class="mb-3">
                <label for="salaire" class="form-label">Salaire</label>
                <input type="text" class="form-control" id="salaire" name="salaire" value="{{ $job->salaire }}" required>
            </div>
            <div class="mb-3">
                <label for="type_contrat" class="form-label">Type Contrat</label>
                <input type="text" class="form-control" id="type_contrat" name="type_contrat" value="{{ $job->type_contrat }}" required>
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


