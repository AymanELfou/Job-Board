<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Application Management') }}
        </h2>
    </x-slot>

    
<style>
    .card {
    border-color: red;
    border-width: 1px;
    border-radius: 10px;
    transition: transform 0.2s; /* Ajoute une animation de transition */
  }

  .card:hover {
    transform: scale(1.05); /* Agrandit la carte au survol */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Ombre plus prononcée au survol */
  }

  .card-title {
    font-size: 1.3rem; /* Augmente la taille du titre */
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
        background-color: rgba(245, 16, 0, 0.705); 
        border-radius: 10px; 
        color: white
        transition: background-color 0.3s; /* Transition douce */
    }

    .search-btn:hover {
        background-color: rgb(4, 5, 4); /* Couleur au survol */
        
    }

</style>













<!-- Search Bar and Button aligned in the same row -->
<div class="container col-12 col-md-6 col-lg-4 mt-5">
    <form action="{{ route('applications.search') }}" method="GET" class="d-flex align-items-center mt-4">
        <input class="form-control me-2 search-input flex-grow-1" name="quer" type="search" placeholder="Search by Name, Title" aria-label="Search">
        <button class="btn search-btn flex-shrink-0 text-white" type="submit" style="">Search</button>
    </form>
</div>



    

    <!-- JobSeeker List Component -->
    
    <div class="container mt-5">
       
       {{--  <div class="row">
            
                <div class="col-md-2 col-lg-2 col-xl-2" style="margin-top: 10px;">
                    <div class="card">
                        <img src="{{ asset('imgs/square_14034319.png') }}" class="col-3"  alt="delete" style="width: 40px; height: 40px;"  />
                        <div class="card-body">
                            <h4 class="card-title col-3">Job Title</h4>
                            <p class="card-text col-3"><i>Applicaiont</i></p>
                            <p class="card-text col-3">status</p>
                            <a href="" class="btn btn-danger btn-block col-3" role="button">View more</a>
                        </div>
                    </div>
                </div>
                
            
        </div> --}}

        <div class="row">
    @foreach($applications as $application)
        <div class="card rounded-3 mb-4">
            <div class="card-body p-4">
                <div class="row d-flex align-items-center">
                    <!-- Job Icon -->
                    <div class="col-2 text-center">
                        <img src="{{ asset('imgs/job.png') }}" alt="job" style="width: 50px; height: 50px;" />
                    </div>

                    <!-- Job Title -->
                    <div class="col-3">
                        <h5 class="text-dark mb-0">{{ $application->job->titre ?? 'Job Title' }}</h5>
                    </div>

                    <!-- Applicant's Name -->
                    <div class="col-3">
                        <h5 class="mb-0">{{ $application->profilJobseeker->fullName ?? "Applicant's name" }}</h5>
                    </div>

                    <!-- Status -->
                    <div class="col-2 text-warning">
                        <h5 class="mb-0">{{ $application->status ?? 'Status' }}</h5>
                    </div>

                    <!-- View Details Button -->
                    <div class="col-2">
                        <a href="{{ route('applications.show', $application->id) }}" class="btn btn-primary btn-sm" role="button">
                            View Details
                        </a>
                        <button type="submit" class="btn btn-link p-0 m-2" onclick="return confirm('Are you sure you want to delete?')">
                            <img src="{{ asset('imgs/square_14034319.png') }}" alt="delete" style="width: 30px; height: 30px;" />
                        </button>
                    </div>

                    <!-- Delete Button -->
                    <div class="text-center">
                        <form action="{{ route('applications.destroy', $application->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

        
    </div>


    

</x-app-layout>