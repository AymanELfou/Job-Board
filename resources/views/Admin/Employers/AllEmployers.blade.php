<x-app-layout>
    <x-slot name="header">
        <h2 class=" text-3xl text-gray-800 leading-tight" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
            {{ __('User Management') }}
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
</style>


<div class="text-center">
    <a href="{{ route('jobseeker.index') }}" class=" button-77 mt-2">
       <h5>Job seeker</h5> 
    </a>

    <a href="{{ route('employers.index') }}" class=" button-78">
        <h5>Employers</h5> 
    </a>
</div>



<!-- Search Bar and Button aligned in the same row -->
<!-- Search Bar and Button aligned in the same row -->
<div class="container col-12 col-md-6 col-lg-4 mb-3">
    <form action="{{ route('employers.search') }}" method="GET" class="d-flex align-items-center mt-5">
        <input class="form-control me-2 search-input flex-grow-1" name="nom_entreprise" type="search" placeholder="Search by Company" aria-label="Search">
        <button class="btn search-btn flex-shrink-0" type="submit" style="background-color: rgba(245, 16, 0, 0.705); border-radius: 10px; color: white">Search</button>
    </form>
</div>


    <!-- Employers List Component -->




    @include('incs.alert') 
    <div class="row">
        
        @foreach($Employers as $Employer)
            <div class="col-xs-12 col-sm-6 col-md-4 mb-4 mt-5">
               
                <div class="card rounded-3 shadow-sm h-100">
                    <div class="card-body d-flex flex-column ">
                        <!-- Header du job -->
                        <h5 class="card-title text-primary mb-2">Company: {{ $Employer['nom_entreprise'] }}</h5>
                        <p class="mt-1"><b>Adress:</b> {{ $Employer['adresse'] }}</p>
                        
                        <!-- Détails du job -->
                        <ul class="list-unstyled mb-3">
                            <li><strong>Telephone:</strong> {{ $Employer['telephone'] }}</li>
                            <li><strong>Secteur activite:</strong> {{ $Employer['secteur_activite'] }}</li>
                            
                        </ul>
                        
                        <!-- Description -->
                        <h5>Description:</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($Employer['description'], 100, '...') }}</p>
                        
                        <!-- Boutons d'actions -->
                        <div class=" d-flex justify-content-center">
                            <form action="{{ route('employers.destroy', $Employer->id) }}" method="post" class="">
                                @csrf
                                @method('delete')
                                <button type="submit" class="me-1" onclick="return confirm('Are you sure you want to delete?')">
                                  <img src="{{ asset('imgs/square_14034319.png') }}" alt="delete" style="width: 40px; height: 40px;" />
                                </button>
                            </form>
                           {{--  <a href="employers/{{ $Employer->id }}/edit" class="">
                              <img src="{{ asset('imgs/penc.png') }}" alt="modify" style="width: 40px; height: 40px;" />
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
      </div>














</x-app-layout>
