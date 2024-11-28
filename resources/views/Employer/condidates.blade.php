<x-apps.app-employer>

    <x-slot name="header">
        <div class="flex items-center justify-start h-screen">
            <h1 class="font-semibold text-3xl text-gray-800 leading-tight" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                {{ __('Condidates') }}
            </h1>
        </div>
    </x-slot>

    <style>
        .badge {
    font-size: 0.85rem;
    padding: 0.4em 0.6em;
}

.table-responsive {
    margin-top: 1rem;
}

.table th, .table td {
    vertical-align: middle;
}

.form-select-sm {
    width: auto;
    display: inline-block;
}

    </style>

    <div class="container mt-5">
    <div class="row">
        <div class="col-12">
            @include('incs.alert') 
            <h2 class="mb-4">Your Candidates</h2>

            @if($candidates->isEmpty())
                <div class="alert alert-info">No candidates have applied for your jobs yet.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr class="text-center">
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Applied For</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($candidates as $candidate)
                                <tr class="text-center">
                                    <td class="text-center"> <img  class="ml-2" src="{{ asset('imgs/candi.png') }}" alt="Card-image" style="width: 50px; height: 50px;">      </td>
                                    <td>{{ $candidate->profilJobseeker->fullName ?? 'N/A' }}</td>
                                    <td>{{ $candidate->profilJobseeker->contact_information ?? 'N/A' }}</td>
                                    <td>{{ $candidate->job->titre }}</td>
                                    <td>
                                        <!-- Display current status -->
                                        <span class="badge 
                                            {{ $candidate->status == 'pending' ? 'bg-warning' : '' }}
                                            {{ $candidate->status == 'approved' ? 'bg-success' : '' }}
                                            {{ $candidate->status == 'rejected' ? 'bg-danger' : '' }}">
                                            {{ $candidate->status }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <!-- Actions: View, Download Resume, Update Status -->
                                        <a href="{{ route('candidates.show', $candidate->id) }}" class="btn btn-info btn-sm m-1">View Profile</a>

                                        {{-- @if ($candidate->resume)
                                            <a href="{{ asset('storage/' . $candidate->resume) }}" target="_blank" class="btn btn-secondary btn-sm">Download Resume</a>
                                        @endif --}}

                                        <form action="{{ route('applications.updateStatus', $candidate->id) }}" method="POST" class="d-inline m-1">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                <option value="pending" {{ $candidate->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="approved" {{ $candidate->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                                <option value="rejected" {{ $candidate->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
</x-apps.app-employer>