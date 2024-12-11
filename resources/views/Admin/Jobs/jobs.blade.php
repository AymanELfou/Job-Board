<x-app-layout>
    <x-slot name="header">
        <h2 class="h1 text-3xl text-gray-800 leading-tight" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
            {{ __('Job Management') }}
        </h2>
    </x-slot>

    <!-- Custom Inline CSS -->
  <style>
    .add-job-btn {
        width: 100%;
        max-width: 200px;
        transition: background-color 0.3s, color 0.3s; /* Transition douce */
    }
    .add-job-btn:hover {
        background-color: red;
        color: white;
    }
    
    .search-input {
        width: 100%;
        max-width: 400px;
        border-radius: 5px; /* Coins arrondis */
        border: 1px solid #ced4da; /* Bordure grise */
        transition: border-color 0.3s; /* Transition douce pour la bordure */
    }
    
    .search-input:focus {
        border-color: #28a745; /* Changement de couleur de la bordure au focus */
        box-shadow: 0 0 5px rgba(40, 167, 69, 0.5); /* Ombre au focus */
    }

    .search-btn {
        background-color: #28a745;
        color: white;
        transition: background-color 0.3s; /* Transition douce */
    }

    .search-btn:hover {
        background-color: darkgreen; /* Couleur au survol */
    }
</style>

<!-- Button to add a new job -->


<!-- Search Bar and Button aligned in the same row -->
<div class="container mt-5">
    <form action="{{ route('jobs.search') }}" method="GET" class="d-flex align-items-center mt-4">
        <input class="form-control me-2 search-input flex-grow-1" name="keyword" type="search" placeholder="Job category, location, job type" aria-label="Search">
        <button class="btn search-btn flex-shrink-0 add-job-btn" type="submit">Search</button>
    </form>
</div>
    

    <!-- Job List Component -->
    <x-job-list :jobs="$jobs" />

</x-app-layout>
