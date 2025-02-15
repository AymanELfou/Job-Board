<x-app-layout>
    <x-slot name="header">
        <h2 class="h1 text-3xl text-gray-800 leading-tight" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
            {{ __('Application Details') }}
        </h2>
    </x-slot>










<div class="container mt-5">
    <div class="card">
        
        <div class="card-body">
            <!-- Job Details -->
            <div class="row m-3 ">
                <i><h4 class="mb-4 text-danger ">Job Information</h4></i>
                <p><strong>Job Title:</strong> {{ $application->job->titre ?? 'N/A' }}</p>
                <p><strong>Company:</strong> {{ $application->job->profilEmployer->nom_entreprise ?? 'N/A' }}</p>
                <p><strong>Location:</strong> {{ $application->job->location ?? 'N/A' }}</p>
                <p><strong>Job Description:</strong> {{ $application->job->description ?? 'N/A' }}</p>
            </div>
            

            <hr>

            <!-- Applicant Details -->
            <div class="row m-3 mt-3">
                <i><h4 class="mb-4 text-danger ">Applicant Information</h4></i>
                <p><strong>Full Name:</strong> {{ $application->profilJobseeker->fullName ?? 'N/A' }}</p>
                <p><strong>Contact Information:</strong> {{ $application->profilJobseeker->contact_information ?? 'N/A' }}</p>
                <p><strong>Skills:</strong> {{ $application->profilJobseeker->competences ?? 'N/A' }}</p>
                <p><strong>Experience:</strong> {{ $application->profilJobseeker->experience ?? 'N/A' }}</p>
                <p><strong>Education:</strong> {{ $application->profilJobseeker->education ?? 'N/A' }}</p>
            </div>
            

            <hr>

            <!-- Application Status -->
            <div class="row  m-3 mt-3">
                <i><h4 class="mb-4 text-danger">Application Status</h4></i>
                <p><strong>Status:</strong> {{ $application->status ?? 'Pending' }}</p>
    
                <!-- Resume Download -->
               {{--  <div class="d-block">
                    @if ($application->profilJobseeker->resume)
                    <a href="{{ asset('storage/' . $application->profilJobseeker->resume) }}" class="btn btn-primary" target="_blank">
                        Download Resume
                    </a>
                @else
                    <p><strong>Resume:</strong> Not uploaded</p>
                @endif
                </div> --}}
                
    
                <!-- Buttons -->
                <div class="">
                    <a href="{{ route('applications.index') }}" class=""> 
                        <img src="{{ asset('imgs/arrow.png') }}" alt="delete" style="width: 50px; height: 50px;"  />                
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</div>
</x-app-layout>