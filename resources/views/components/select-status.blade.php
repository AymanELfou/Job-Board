<form action="{{ route('applications.updateStatus', $application->id) }}" method="POST">
    @csrf
    @method('PUT')
    <select name="status" class="form-select mb-3" onchange="this.form.submit()">
        <option value="Pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="Approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved</option>
        <option value="Rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
    </select>
</form>