<x-apps.app-jobseeker>

    <x-slot name="header">
        <h1 class=" text-3xl text-gray-800 leading-tight" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
            {{ __('My Applications') }}
        </h1>
    </x-slot>


    <style>
        .card {
        border-width: 2px;
        border-radius: 10px;
        transition: transform 0.2s; /* Ajoute une animation de transition */
        background-color: 0 4px 20px rgba(0, 0, 0, 0.2);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Ombre plus prononcée au survol */
      }
    
      .card:hover {
        transform: scale(1.05); /* Agrandit la carte au survol */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Ombre plus prononcée au survol */
    } 
    </style>


    <div class="container mt-5">
        @if($applications->isEmpty())
        <div class="alert alert-info">You have not applied to any jobs yet.</div>
       @else
    <div class="row">
        @foreach($applications as $application)
            <div class="card rounded-3 mb-4">
                <div class="card-body p-4">
                    <div class="row d-flex align-items-center">
                        <!-- Job Icon -->
                        <div class="col-2 text-center">
                            <img src="{{ asset('imgs/jobapp.jpg') }}" alt="job" style="width: 70px; height: 70px;" class="rounded" />
                        </div>
    
                        <!-- Job Title -->
                        <div class="col-3"><span class="text-danger fs-5 m-1">Job Title:</span>
                            <h4 class="text-dark mb-0 m-1">{{ $application->job->titre ?? 'Job Title' }}</h4>
                        </div>
    
                        <!-- Applicant's Name -->
                        <div class="col-3"> <span class="text-danger fs-5 m-1">Company:</span>
                            <h4 class="mb-0 fs-5 m-1">{{ $application->job->profilEmployer->nom_entreprise ?? "Applicant's name" }}</h4>
                        </div>
    
                        <!-- Status -->
                        <div class="col-2 text-warning"><span class="text-danger fs-5 m-1">Status:</span>
                            <h5 class="mb-0 m-1">{{ $application->status ?? 'Status' }}</h5>
                        </div>
    
                        <!-- View Details Button -->
                        <div class="col-2">
                            <a href="{{ route('jobseeker.applications.show', $application->id) }}" class="btn btn-sm" role="button">
                                <img src="{{ asset('imgs/eye.png') }}" alt="delete" style="width: 42px; height: 42px;" />
                            </a>
                            <form action="{{ route('jobseeker.applications.destroy', $application->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-link p-0" onclick="return confirm('Are you sure you want to delete?')">
                                    <img src="{{ asset('imgs/square_14034319.png') }}" alt="delete" style="width: 30px; height: 30px;" />
                                </button>
                            </form>
                        </div>
    
                        <!-- Delete Button -->
                        <div class="text-center">
                            
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div>

            



































</x-apps.app-jobseeker>