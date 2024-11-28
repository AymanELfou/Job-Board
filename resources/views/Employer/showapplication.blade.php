<x-apps.app-employer>

    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight text-white fs-1 text-center">
            {{ __('View Application') }}
        </h2>
    </x-slot>

    <style>
        .container {
            background-color: rgb(105, 101, 96);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card {
            border-radius: 10px;
            transition: box-shadow 0.3s;
        }
        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .card-header {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .badge {
            font-size: 1rem;
            padding: 0.5em 1em;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .badge.bg-warning:hover {
            background-color: #ffc107;
        }
        .badge.bg-success:hover {
            background-color: #28a745;
        }
        .badge.bg-danger:hover {
            background-color: #dc3545;
        }
        /* .form-select {
            border-radius: 5px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s;
        }
        .form-select:focus {
            border-color: #80bdff;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        } */
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
            transform: translateY(-2px);
        }
    </style>
             @include('incs.alert') 
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Application Card -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <i><h3 class="mb-0">Application Details</h3></i>
                    </div>
                    <div class="card-body">
                        <!-- Job Information -->
                        <i><h5 class="card-title mb-3">Job Information</h5></i>
                        <p><strong>Title:</strong> {{ $application->job->titre }}</p>
                        <p><strong>Posted by:</strong> {{ $application->job->company }}</p>
                        <p><strong>Job Description:</strong> {{ $application->job->description }}</p>
                        <hr>

                        <!-- Applicant Information -->
                        <i><h5 class="card-title mb-3">Applicant Information</h5></i>
                        <p><strong>Name:</strong> {{ $application->profilJobseeker->fullName ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $application->profilJobseeker->contact_information ?? 'N/A' }}</p>
                        <hr>

                        <!-- Application Status -->
                        <i><h5 class="card-title mb-3">Application Status</h5></i>
                        <p> <strong>Current Status:</strong>  
                            <span class="badge m-1 
                                {{ $application->status == 'pending' ? 'bg-warning' : '' }}
                                {{ $application->status == 'approved' ? 'bg-success' : '' }}
                                {{ $application->status == 'rejected' ? 'bg-danger' : '' }}">
                                {{ $application->status }}
                            </span>
                        </p>

                        <!-- Status Update Form -->
                        <form action="{{ route('applications.updateStatus', $application->id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="status" class="form-label">Update Status:</label>
                                <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                                    <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('employer.applications.index') }}" class="btn btn-secondary">Back to Applications</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-apps.app-employer>
