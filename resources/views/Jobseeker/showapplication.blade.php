<x-apps.app-jobseeker>

    <x-slot name="header">
        <h1 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Application Details') }}
        </h1>
    </x-slot>





    <div class="container mt-5">
        

        <div class="card">
            <div class="card-header">
                <h4 class="mb-3">{{ $application->job->titre }}</h4>
                <span class="badge bg-primary ">{{ $application->status }}</span>
            </div>
            <div class="card-body">
                <h4 class="mb-3">Company: {{ $application->job->company }}</h4>
                <p><strong>Location:</strong> {{ $application->job->location }}</p>
                <p><strong>Salary:</strong> {{ $application->job->salaire }}</p>
                <p><strong>Job Type:</strong> {{ $application->job->job_type }}</p>
                <p><strong>Contract Type:</strong> {{ $application->job->type_contrat }}</p>
                <p><strong>Description:</strong></p>
                <textarea class="form-control mb-2" id="description" name="description" rows="2" required>{{ $application->job->description }}</textarea>
                <p class="mt-1"><strong>Application Date:</strong> {{ $application->created_at->format('d/m/Y') }}</p>

                {{-- <h5 class="mt-4">Update Application Status</h5>
                <form action="{{ route('applications.update', $application->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="status" class="form-label">Application Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="under_review" {{ $application->status == 'under_review' ? 'selected' : '' }}>Under Review</option>
                            <option value="interview_scheduled" {{ $application->status == 'interview_scheduled' ? 'selected' : '' }}>Interview Scheduled</option>
                            <option value="offer_extended" {{ $application->status == 'offer_extended' ? 'selected' : '' }}>Offer Extended</option>
                            <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="withdrawn" {{ $application->status == 'withdrawn' ? 'selected' : '' }}>Withdrawn</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form> --}}

                {{-- <form action="{{ route('jobseeker.applications.destroy', $application->id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Withdraw Application</button>
                </form> --}}
            </div>
        </div>

        <a href="{{ route('jobseeker.applications.index') }}" class="btn btn-info mt-4 rounded">Back to Applications</a>
    </div>




















</x-apps.app-jobseeker>