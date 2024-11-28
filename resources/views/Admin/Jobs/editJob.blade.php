<x-app-layout>


    <x-slot name="header">
        <div class="flex items-center justify-center h-screen">
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                {{ __('Edit job') }}
            </h2>
        </div>
    </x-slot>





    <div class="container my-5">
        <form action="{{ route('jobs.update', $job->id) }}" method="POST" class="mb-4">
            @csrf
            @method("PUT")
    
            <input type="hidden" name="id_employeur" value="{{ auth()->user()->id }}">
    
            <div class="mb-3">
                <x-input-label  for="titre"  :value="__('Titre job')"/>
                <input type="text" class="form-control" id="titre" name="titre" value="{{ $job->titre }}" required>
            </div>
            <div class="mb-3">
                <label for="company" class="form-label">Entreprise</label>
                <input type="text" class="form-control" id="company" name="company" value="{{ $job->company }}" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Localisation</label>
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
            <button type="submit" class="btn btn-danger" style="background-color: ">Save Job</button>
        </form>
    </div>
    


</x-app-layout>


