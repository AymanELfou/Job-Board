<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-center h-screen">
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                {{ __('Job Management') }}
            </h2>
        </div>
    </x-slot>



    <div class="flex justify-center">
        <a href="{{ route('jobs.create') }}" class="btn btn-primary mt-4 text-3xl bg-blue-500 leading-tight text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 transition duration-200">
            Créer un Job <img src="{{{ asset('') }}}" alt="" srcset="">
        </a>
    </div>



    @foreach($jobs as $job)
        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              
              <div class="col-xs-12 col-sm-6 col-md-4">
                <p class="lead fw-normal mb-2">Titre {{ $job['titre'] }}</p>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-4">
                <h5 class="mb-0">{{ $job['company'] }}</h5>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-4">
                <h5 class="mb-0">{{ $job['location'] }}</h5>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-4">
                <h5 class="mb-0">{{ $job['type'] }}</h5>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-4">
                <h5 class="mb-0">{{ $job['category'] }}</h5>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-4">
                <h5 class="mb-0">{{ $job['salaire'] }}</h5>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-4">
                <h5 class="mb-0">{{ $job['type_contrat'] }}</h5>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-4">
                <h5 class="mb-0">{{ $job['date_publication'] }}</h5>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-4">
                <h5 class="mb-0">{{ $job['description'] }}</h5>
              </div>
              








              {{-- edit/destroy --}}
              <div class="col-md-3 col-lg-3 col-xl-2">
                <h5 class="mb-0">
                  <div class="d-flex col-6">
                    
                  
                  <form action="{{ route('jobs.destroy',$job->id) }}" method="post">
                    @csrf
                    @method('delete')
                    
                    <button style="border: none; cursor: pointer;">
                      <img src="{{ asset('imgs/square_14034319.png') }}" alt="delete" style="width: 50px; height: 50px;" />
                    </button>
                    
                  </form>
                  
                  
                  <a href="jobs/{{ $job->id }}/edit"><img src="{{ asset('imgs/pen.png') }}" alt="modify" style="width: 50px; height: 50px;" /></div></a>
                </h5>
                

              </div>
            </div>
          </div>
        </div>
        @endforeach




    
    
    



</x-app-layout>