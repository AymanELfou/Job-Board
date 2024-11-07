@extends('layout.app')

@section('title')

@section('content')

<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Créer un Job</h1>
    <form action="{{ route('jobs.store') }}" method="POST" class="space-y-4">
        @csrf

        <input type="hidden" name="id_employeur" value="{{ auth()->user()->id }}">

        <div>
            <label for="titre" class="block text-sm font-medium text-gray-700">Titre du Job</label>
            <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="titre" name="titre" required>
        </div>
        <div>
            <label for="company" class="block text-sm font-medium text-gray-700">Entreprise</label>
            <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="company" name="company" required>
        </div>
        <div>
            <label for="location" class="block text-sm font-medium text-gray-700">Localisation</label>
            <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="location" name="location" required>
        </div>
        <div>
            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
            <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="type" name="job_type" required>
        </div>
        <div>
            <label for="category" class="block text-sm font-medium text-gray-700">Catégorie</label>
            <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="category" name="categorie" required>
        </div>
        <div>
            <label for="salaire" class="block text-sm font-medium text-gray-700">Salaire</label>
            <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="salaire" name="salaire" required>
        </div>
        <div>
            <label for="type_contrat" class="block text-sm font-medium text-gray-700">Type Contrat</label>
            <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="type_contrat" name="type_contrat" required>
        </div>
        <div>
            <label for="date_publication" class="block text-sm font-medium text-gray-700">Date publication</label>
            <input type="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="date_publication" name="date_publication" required>
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" id="description" name="description" rows="4" required></textarea>
        </div>
        <button type="submit" class="mt-4 bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600">Créer le Job</button>
        
    </form>
</div>

@endsection
