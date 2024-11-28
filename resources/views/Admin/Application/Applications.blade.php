<x-app-layout>
    <x-slot name="header">
        <h2 class="h1 text-3xl text-gray-800 leading-tight" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
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
            @include('incs.alert')
            @if($applications->isEmpty())
            <div class="alert alert-info">No Application existed yet.</div>
           @else
    @foreach($applications as $application)
        <div class="card rounded-3 mb-4">
            <div class="card-body p-4">
                <div class="row d-flex align-items-center">
                    <!-- Job Icon -->
                    <div class="col-2 text-center">
                        <img src="{{ asset('imgs/job.png') }}" alt="job" style="width: 50px; height: 50px;" />
                    </div>

                    <!-- Job Title -->
                    <div class="col-3"><i><span class="text-danger fs-4 mb-3">Job Title:</span></i>
                        <h5 class="text-dark mb-0 mt-2">{{ $application->job->titre ?? 'Job Title' }}</h5>
                    </div>

                    <!-- Applicant's Name -->
                    <div class="col-3"><i><span class="text-danger fs-4 mb-3">Applicant's name:</span></i>
                        <h5 class="mb-0 mt-2">{{ $application->profilJobseeker->fullName ?? "Applicant's name" }}</h5>
                    </div>

                    <!-- Status -->
                    <div class="col-2 text-warning">
                        <form action="{{ route('updateStatus', $application->id) }}" method="POST" class="mb-0 m-1">
                            @csrf
                            @method('PUT')
                    
                            <!-- Menu déroulant pour changer le statut --><i><span class="text-danger fs-4 mb-3">Status:</span></i>
                            <select name="status" id="status-{{ $application->id }}" class="form-select mt-1" onchange="this.form.submit()">
                                <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </form>
                    </div>

                    
                    <div class="col-2 mt-4">
                        
                        <!-- View Details Button -->
                        <a href="{{ route('applications.show', $application->id) }}" class="btn btn-sm" role="button">
                            <img src="{{ asset('imgs/eye.png') }}" alt="delete" style="width: 42px; height: 42px;" />
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('applications.destroy', $application->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-link p-0" onclick="return confirm('Are you sure you want to delete?')">
                                <img src="{{ asset('imgs/square_14034319.png') }}" alt="delete" style="width: 30px; height: 30px;" />
                            </button>
                        </form>
                    </div>

                    
                   
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif

        
    </div>


    

</x-app-layout>
