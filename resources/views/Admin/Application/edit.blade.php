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
</form>