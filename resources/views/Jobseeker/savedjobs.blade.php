<x-apps.app-jobseeker>

    <x-slot name="header">
        <h1 class="text-3xl text-gray-800 leading-tight" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
            {{ __('Saved Jobs') }}
        </h1>
    </x-slot>

<style>
    .card {
    border-color: red;
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




<div class="container mt-3 pt-4">
    @include('incs.alert')

        @if($savedjobs->isEmpty())
            <div class="alert alert-info">You have not saved any jobs yet.</div>
        @else
        <div class="row">
            @foreach($savedjobs as $savedjob)
                <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                    <div class="card border-0 bg-light rounded shadow">
                        <div class="card-body p-4">
                            <span class="badge rounded-pill bg-primary float-md-end mb-3 mb-sm-0">{{ $savedjob->job->job_type }}</span>
                            <h4>{{ $savedjob->job->titre }}</h4>
                            <div class="mt-3">
                                <span class="text-muted d-block mb-2"><i class="bi bi-geo-alt-fill"></i> {{ $savedjob->job->location }}</span>
                                <span class="text-muted d-block mb-2"><i class="bi bi-building-check"></i> {{ $savedjob->job->profilEmployer->nom_entreprise }} - {{ $savedjob->job->categorie }}</span>
                                <span class="text-muted d-block mb-2"><i class="bi bi-currency-dollar"></i> {{ $savedjob->job->salaire }} - <i class="bi bi-file-earmark-text"></i> {{ $savedjob->job->type_contrat }}</span>
                                <span class="text-muted d-block">Description:</span>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($savedjob->job->description, 200, '...') }}</p>
                            </div>
                            
                            <div class="mt-3">
                                {{-- Apply button --}}
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyModal{{ $savedjob->job->id }}">
                                    <i class="bi bi-check-circle fill"></i> Apply
                                </button>

                                {{-- Save button --}}
                                <form action="{{ route('jobs.save', $savedjob->job->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        
                                        @if($savedjob->job->isSavedBy(auth()->user()->profile)) 
                                        <i class="bi bi-bookmark-x save-icon"></i>
                                        UnSave
                                        @else 
                                        <i class="bi bi-save"></i> Save
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->

                <!-- Application Modal -->
                <div class="modal fade" id="applyModal{{ $savedjob->job->id }}" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('jobs.apply', $savedjob->job->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="applyModalLabel">Apply for {{ $savedjob->job->titre }}</h5>
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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!--end modal-->
            @endforeach
        </div><!--end row-->
        @endif
</div><!--end container-->


</x-apps.app-jobseeker>