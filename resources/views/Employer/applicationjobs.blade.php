<x-apps.app-employer>


    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('My Applications') }}
        </h2>
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

        <div class="row">
             @include('incs.alert') 

            @if($applications->isEmpty())
             <div class="alert alert-info">No Application have applied for your jobs.</div>
            @else


            @foreach($applications as $application)
                <div class="card rounded-3 mb-4">
                    <div class="card-body p-4">
                        <div class="row d-flex align-items-center">
                            <!-- Job Icon -->
                            <div class="col-2 text-center">
                                <img src="{{ asset('imgs/jobapp.jpg') }}" alt="job" style="width: 70px; height: 70px;" class="rounded" />
                            </div>
        
                            <!-- Job Title -->
                            <div class="col-3">
                                <h4 class="text-dark mb-0 m-1">{{ $application->job->titre ?? 'Job Title' }}</h4>
                            </div>
        
                            <!-- Applicant's Name -->
                            <div class="col-3"> 
                                <h4 class="mb-0 fs-5 m-1">{{ $application->profilJobseeker->fullName ?? "Applicant's name" }}</h4>
                            </div>
        
                            <!-- Status -->
                            <div class="col-2 text-warning">
                                <form action="{{ route('applications.updateStatus', $application->id) }}" method="POST" class="mb-0 m-1">
                                    @csrf
                                    @method('PUT')
                            
                                    <!-- Menu déroulant pour changer le statut -->
                                    <select name="status" id="status-{{ $application->id }}" class="form-select" onchange="this.form.submit()">
                                        <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </form>

                                
                            </div>
        
                            <!-- View Details Button -->
                            <div class="col-2">
                                <a href="{{ route('employer.applications.show', $application->id) }}" class="btn btn-sm" role="button">
                                    <img src="{{ asset('imgs/eye.png') }}" alt="delete" style="width: 42px; height: 42px;" />
                                </a>
                                <form action="{{ route('employer.applications.destroy', $application->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-link p-0 " onclick="return confirm('Are you sure you want to delete?')">
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




































    {{-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-dark">
    <thead>
        <tr>
            <th>Job Title</th>
            <th>Applicant Name</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($applications as $application)
        <tr>
            <td>{{ $application->job->title }}</td>
            <td>{{ $application->jobSeeker->name }}</td>
            <td>{{ ucfirst($application->status) }}</td>
            <td>
                <a href="{{ route('employer.applications.show', $application->id) }}" class="btn btn-primary">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
 --}}























































    
</x-apps.app-employer>
