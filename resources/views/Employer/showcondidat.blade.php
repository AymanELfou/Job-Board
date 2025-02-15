<x-apps.app-employer>

    <x-slot name="header">
        <div class="flex items-center justify-center h-screen">
            <h2 class="font-semibold fs-1 text-gray-800 leading-tight">
                {{ __('Profile Condidate') }}
            </h2>
        </div>
    </x-slot>


    <style>
          .badge {
    font-size: 0.85rem;
    padding: 0.4em 0.6em;
}
    </style>

    <div class="container mt-5">
        <div class="row">
            <div class="col-9 mx-auto">
                @include('incs.alert')
                <div class="card shadow">
                    <div class="card-header text-danger rounded">
                        <img class="card-img text-center mx-auto border-none" src="{{ asset('imgs/job-seeker.png') }}" alt="Card-image " style="width: 350px; height: 300px;">
                        
                    </div>
                    <div class="card-body">
                        <!-- Candidate's Personal Information -->
                        <h4 class="card-title mb-3 text-danger">Personal Information</h4>
                        <div class="mb-3">
                            <strong>Full Name:</strong> {{ $application->profilJobseeker->fullName ?? 'N/A' }}
                        </div>
                        <div class="mb-3">
                            <strong>Email:</strong> {{ $application->profilJobseeker->contact_information ?? 'N/A' }}
                        </div>
                        <div class="mb-3">
                            <strong>Competences:</strong> {{ $application->profilJobseeker->competences ?? 'N/A' }}
                        </div>
                        <div class="mb-3">
                            <strong>Education:</strong> {{ $application->profilJobseeker->education ?? 'N/A' }}
                        </div>
                        <div class="mb-3">
                            <strong>Experience:</strong> {{ $application->profilJobseeker->experience ?? 'N/A' }}
                        </div>
                        <hr>
    
                        <!-- Application Details -->
                        <h4 class="card-title mb-3 text-danger">Application Details</h4>
                        <div class="mb-3">
                            <strong>Applied Job:</strong> {{ $application->job->titre }}
                        </div>
                        <div class="mb-3">
                            <strong>Current Status:</strong>
                            <span class="badge 
                                {{ $application->status == 'pending' ? 'bg-warning' : '' }}
                                {{ $application->status == 'approved' ? 'bg-success' : '' }}
                                {{ $application->status == 'rejected' ? 'bg-danger' : '' }}">
                                {{ $application->status }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <strong>Cover Letter:</strong>
                            <textarea class="form-control">{{ $application->cover_letter ?? 'No cover letter provided.' }}</textarea>
                        </div>
                        <hr>
    
                        <!-- Resume -->
                        <h4 class="card-title mb-3 text-danger">Resume</h4>
                        @if ($application->resume)
                            <a href="{{ asset('storage/' . $application->resume) }}" target="_blank" class="btn btn-secondary">
                                Download Resume
                            </a>
                        @else
                            <p>No resume uploaded.</p>
                        @endif
                        <hr>
    
                        <!-- Update Status -->
                        <h4 class="card-title mb-3 text-danger">Update Application Status</h4>
                        <form action="{{ route('applications.updateStatus', $application->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select mb-3" onchange="this.form.submit()">
                                <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </form>
    
                        <a href="{{ route('employer.candidates') }}" class="btn btn-primary mt-3">Back to Candidates</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    











</x-apps.app-employer>