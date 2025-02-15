<x-apps.app-employer>
    <x-slot name="header">
        <h2 class="h1 text-dark" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
            {{ __('Job Management') }}
        </h2>
    </x-slot>



    <div class="mt-5">
        <a href="{{ route('employer.jobs.create') }}" class="" style="width: 160px;">
            <img src="{{ asset('imgs/plusg.png') }}" alt="Add"  style="width: 65px; height: 65px;">
            
        </a>
    </div>
    
    
    
    <!-- Search Bar and Button aligned in the same row -->
    <div class="container col-12 col-md-6 col-lg-4">
        <div class="row">
          <form action="{{ route('employer.jobs.search') }}" method="GET" class="d-flex align-items-center ">
            <input class="form-control me-2 search-input flex-grow-1" name="keyword" type="search" placeholder="Title, Job type, Location" aria-label="Search">
            <button class="btn search-btn flex-shrink-0" type="submit" style="background-color: rgba(245, 16, 0, 0.705); border-radius: 10px; color: white">Search</button>
        </form>
        </div>
        
    </div>






    <style>
        .card {
          border-color: red;
          border-width: 1px;
          border-radius: 15px;
          transition: transform 0.2s; /* Ajoute une animation de transition */
        }
      
        .card:hover {
          transform: scale(1.05); /* Agrandit la carte au survol */
          box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Ombre plus prononcée au survol */
        }
      
        .card-title {
          font-size: 1.5rem; /* Augmente la taille du titre */
          font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
      
        .card-body {
          background-color: #f8f9fa; /* Couleur de fond légèrement grise */
        }
      
        .list-unstyled li {
          margin-bottom: 5px; /* Espacement entre les éléments de la liste */
        }
      
        .btn {
          background-color: red; /* Couleur de fond des boutons */
          color: white; /* Couleur du texte des boutons */
          border: none; /* Supprime la bordure par défaut */
          border-radius: 5px; /* Arrondit les coins des boutons */
        }
      
        .btn:hover {
          background-color: rgba(117, 122, 116, 0.815); /* Couleur de fond au survol */
        }


        .add-job-btn{
            background-color: rgba(196, 115, 39, 0.815);
            border-radius: 15px;
            padding: 6px;
        }




      </style>
      <div class="m-3">
        @include('incs.alert')
      </div>
     
      <div class="row">
        @foreach($jobs as $job)
            <div class="col-xs-12 col-sm-6 col-md-4 mb-4 mt-5">
                <div class="card rounded-3 shadow-sm h-100">
                    <div class="card-body d-flex flex-column ">
                        <!-- Header du job -->
                        <h5 class="card-title text-primary mb-2">{{ $job['titre'] }}</h5>
                        <p class="mb-2"><i class="bi bi-geo-alt-fill"></i> <b>Location:</b> {{ $job['location'] }}</p>
                        
                        <!-- Détails du job -->
                        <ul class="list-unstyled mb-3">
                            <li><strong><i class="bi bi-house-door"></i> Type:</strong> {{ $job['job_type'] }}</li>
                            <li><strong>Catégorie:</strong> {{ $job['categorie'] }}</li>
                            <li><i class="bi bi-currency-dollar"></i> <strong>Salaire:</strong> {{ $job['salaire'] }}</li>
                            <li><i class="bi bi-file-earmark-text"></i> <strong>Contrat:</strong> {{ $job['type_contrat'] }}</li>
                            <li><strong> <i class="bi bi-clock-history"></i> Date de publication:</strong> {{ $job['date_publication'] }}</li>
                        </ul>
                        
                        <!-- Description -->
                        <h5>Description:</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($job['description'], 250, '...') }}</p>
                        
                        <!-- Boutons d'actions -->
                        <div class="mt-auto d-flex justify-content-center">
                            <form action="{{ route('employer.jobs.destroy', $job->id) }}" method="post" class="me-2">
                                @csrf
                                @method('delete')
                                <button type="submit"  onclick="return confirm('Are you sure you want to delete?')">
                                  <img src="{{ asset('imgs/square_14034319.png') }}" alt="delete" style="width: 35px; height: 35px;" class="mt-1"/>
                                </button>
                            </form>
                            <a href="/employer/jobs/{{ $job->id }}/edit" class="" >
                              <img src="{{ asset('imgs/editb.png') }}" alt="modify" style="width: 45px; height: 45px;" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mt-4 d-flex justify-content-center">
          {{ $jobs->links() }}
        </div>
      </div>






</x-apps.app-employer>