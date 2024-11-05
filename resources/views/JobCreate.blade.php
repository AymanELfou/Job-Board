@extends('layout.app')

@section('title','Create Job')

@section('content')



<div class="container">
    <h1>Créer un Job</h1>
    <form action="{{ route('jobs.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="job_Title" class="form-label">Titre du Job</label>
            <input type="text" class="form-control" id="job_Title" name="job_Title" required>
        </div>
        <div class="mb-3">
            <label for="company" class="form-label">Entreprise</label>
            <input type="text" class="form-control" id="company" name="company" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Localisation</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" class="form-control" id="type" name="type" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Catégorie</label>
            <input type="text" class="form-control" id="category" name="category" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Créer le Job</button>
    </form>
</div>



@endsection