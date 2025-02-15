<style>
  .card {
    border:1px solid ;
    border-color: red;
    border-width: 2px;
    border-radius: 13px;
     
    transition: transform 0.2s; /* Ajoute une animation de transition */
  }

  .card:hover {
    transform: scale(1.05); /* Agrandit la carte au survol */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Ombre plus prononcée au survol */
  }

  .card-title {
    font-size: 1.5rem; /* Augmente la taille du titre */
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
    background-color: darkred; /* Couleur de fond au survol */
  }
</style>

<div class="row">
  @foreach($jobs as $job)
      <div class="col-xs-12 col-sm-6 col-md-4 mb-4 mt-5">
          <div class="card rounded-3 shadow-sm h-100">
              <div class="card-body d-flex flex-column ">
                  <!-- Header du job -->
                  <h5 class="card-title text-primary mb-2">{{ $job['titre'] }}</h5>
                  <p class="mb-2"><b>Entreprise:</b> {{ $job['company'] }} - <b>Localisation:</b> {{ $job['location'] }}</p>
                  
                  <!-- Détails du job -->
                  <ul class="list-unstyled mb-3">
                      <li><strong>Type:</strong> {{ $job['job_type'] }}</li>
                      <li><strong>Catégorie:</strong> {{ $job['categorie'] }}</li>
                      <li><strong>Salaire:</strong> {{ $job['salaire'] }}</li>
                      <li><strong>Contrat:</strong> {{ $job['type_contrat'] }}</li>
                      <li><strong>Date de publication:</strong> {{ $job['date_publication'] }}</li>
                  </ul>
                  
                  <!-- Description -->
                  <h5>Description:</h5>
                  <p class="card-text">{{ \Illuminate\Support\Str::limit($job['description'], 100, '...') }}</p>
                  
                  <!-- Boutons d'actions -->
                  <div class="mt-auto d-flex justify-content-center">
                      <form action="{{ route('jobs.destroy', $job->id) }}" method="post" class="me-2">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn" onclick="return confirm('Are you sure you want to delete?')">
                            <img src="{{ asset('imgs/square_14034319.png') }}" alt="delete" style="width: 30px; height: 30px;" />
                          </button>
                      </form>
                     {{--  <a href="jobs/{{ $job->id }}/edit" class="btn">
                        <img src="{{ asset('imgs/penc.png') }}" alt="modify" style="width: 30px; height: 30px;" />
                      </a> --}}
                  </div>
              </div>
          </div>
      </div>
  @endforeach
  <div class="mt-4 d-flex justify-content-center">
    {{ $jobs->links() }}
  </div>
</div>

























{{-- <div class="row">
  @foreach($jobs as $job)
      <div class="col-xs-12 col-sm-6 col-md-4 mb-4">
          <div class="card rounded-3 text-center mt-5">
              <div class="card-body p-4">
                  <h5 class=" mb-2">Titre : {{ $job['titre'] }}</h5>
                  <h5 class="mb-2">Entreprise : {{ $job['company'] }}</h5>
                  <h5 class="mb-2">Localisation : {{ $job['location'] }}</h5>
                  <h5 class="mb-2">Type : {{ $job['job_type'] }}</h5>
                  <h5 class="mb-2">Catégorie : {{ $job['categorie'] }}</h5>
                  <h5 class="mb-2">Salaire : {{ $job['salaire'] }}</h5>
                  <h5 class="mb-2">Type de contrat : {{ $job['type_contrat'] }}</h5>
                  <h5 class="mb-2">Date de publication : {{ $job['date_publication'] }}</h5>
                  <h5 class="mb-2">Description : {{ $job['description'] }}</h5>
                  
                  <div class="d-flex justify-content-center mt-3">
                      {{-- Edit/Delete --}}
                      {{-- <form action="{{ route('jobs.destroy', $job->id) }}" method="post" class="me-2">
                          @csrf
                          @method('delete')
                          <button type="submit" style="border: none; cursor: pointer;" onclick="return confirm('Are you sure you want to delete?')">
                              <img src="{{ asset('imgs/square_14034319.png') }}" alt="delete" style="width: 30px; height: 30px;" />
                          </button>
                      </form>
                      <a href="jobs/{{ $job->id }}/edit">
                          <img src="{{ asset('imgs/pen.png') }}" alt="modify" style="width: 30px; height: 30px;" />
                      </a>
                  </div>
              </div>
          </div>
      </div>
  @endforeach
</div> --}}
