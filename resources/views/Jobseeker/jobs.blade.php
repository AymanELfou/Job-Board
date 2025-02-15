<x-apps.app-jobseeker>

    <x-slot name="header">
        <h1 class=" text-3xl text-gray-800 leading-tight" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
            {{ __('Find the perfect jobs') }}
        </h1>
    </x-slot>

<style>
    .card {
    border-width: 2px;
    border-radius: 10px;
    
    transition: transform 0.2s; /* Ajoute une animation de transition */
  }

  .card:hover {
    transform: scale(1.05); /* Agrandit la carte au survol */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Ombre plus prononcée au survol */
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



<div class="container ">
    <form action="{{ route('jobseeker.jobs.search') }}" method="GET" class="d-flex align-items-center mt-5">
        <input class="form-control me-2 search-input flex-grow-1" name="categorie" type="search" placeholder="Search by Category" >
        <input class="form-control me-2 search-input flex-grow-1" name="location" type="search" placeholder="Search by Location" >
        <button class="btn search-btn flex-shrink-0" type="submit" style="background-color: rgba(245, 16, 0, 0.705); border-radius: 10px; color: white">Search</button>
    </form>
</div>










    <div class="container mt-3 pt-4">
        @include('incs.alert')
        
        @if($jobs->isEmpty())
        <div class="alert alert-danger text-center" role="alert">
            No jobs Found.
          </div>
        @else

        <div class="row">
            @foreach($jobs as $job)
            <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                <div class="card border-0 bg-light rounded shadow">
                    <div class="card-body p-4">
                        <span class="badge rounded-pill bg-primary float-md-end mb-3 mb-sm-0">{{ $job['job_type'] }}</span>
                        <h4>{{ $job['titre'] }}</h4>
                        <div class="mt-3">
                            <span class="text-muted d-block mb-2"><i class="bi bi-geo-alt-fill"></i>  {{ $job['location'] }}</span>
                            <span class="text-muted d-block mb-2"><i class="bi bi-building-check"></i>   {{ $job->profilEmployer->nom_entreprise }} - {{ $job['categorie'] }}</span>
                            <span class="text-muted d-block mb-2"><i class="bi bi-currency-dollar"></i>  {{ $job['salaire'] }} - <i class="bi bi-file-earmark-text"></i>  {{ $job['type_contrat'] }}</span>
                            <span class="text-muted d-block"></i> Description: </span><p class="card-text">{{ \Illuminate\Support\Str::limit($job['description'], 200, '...') }}</p>

                        </div>
                        
                        <div class="mt-3">
                                {{-- Apply button --}}
                                
                                @if ($job->applications->where('id_jobseeker', auth()->user()->profile->id)->isEmpty())
                                     <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyModal{{ $job->id }}">
                                         <i class="bi bi-check-circle fill"></i> Apply
                                     </button>
                                 @else
                                     <button class="btn btn-dark" disabled>
                                         <i class="bi bi-check-circle fill"></i> Already Applied
                                     </button>
                                 @endif

                            {{-- Save button --}}
                            <form action="{{ route('jobs.save',$job->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="">
                                    @if($job->isSavedBy(auth()->user()->profile)) 
                                    <span class="btn btn-danger"><i class="bi bi-bookmark-x save-icon"></i>
                                        UnSave</span>
                                @else 
                                <span class="btn btn-success"><i class="bi bi-bookmark"></i> Save</span>
                                @endif
                                </button>

                            </form>
                            {{-- <button class="btn btn-success">Save</button> --}}
                        </div>

                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
           

             <!-- Application Modal -->
             <div class="modal fade" id="applyModal{{ $job->id }}" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('jobs.apply', $job->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="applyModalLabel">Apply for {{ $job['titre'] }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="resume" class="form-label">Upload Resume</label>
                                    <input type="file" class="form-control" id="resume" name="resume" required>
                                </div>
                                <div class="mb-3">
                                    <label for="cover_letter" class="form-label">Cover Letter</label>
                                    <textarea class="form-control" id="cover_letter" name="cover_letter" rows="4" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Submit Application</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal -->
        @endforeach
            @endif

        </div><!--end row-->
        <div class="mt-4 d-flex justify-content-center">
            {{ $jobs->links() }}
          </div>
    </div><!--end container-->




















</x-apps.app-jobseeker>