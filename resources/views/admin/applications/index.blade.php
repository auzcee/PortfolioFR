@extends('admin.layout')

@section('title', 'Applications Monitoring')

@section('content')
<div class="row mb-4">
    <div class="col-md-5">
        <h2><i class="fas fa-file-alt me-2"></i>Job Applications</h2>
    </div>
    <div class="col-md-3">
        <select class="form-select" onchange="window.location='{{ route('admin.applications.index') }}?status=' + this.value">
            <option value="">All Statuses</option>
            <option value="applied" {{ request('status') == 'applied' ? 'selected' : '' }}>Applied</option>
            <option value="shortlisted" {{ request('status') == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
            <option value="interview" {{ request('status') == 'interview' ? 'selected' : '' }}>Interview</option>
            <option value="hired" {{ request('status') == 'hired' ? 'selected' : '' }}>Hired</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>
    </div>
    <div class="col-md-4">
        <div class="btn-group w-100" role="group">
            <a href="{{ route('admin.applications.export', ['format' => 'csv', 'status' => request('status')]) }}" class="btn btn-sm btn-outline-success">
                <i class="fas fa-file-csv me-1"></i> CSV
            </a>
            <a href="{{ route('admin.applications.export', ['format' => 'excel', 'status' => request('status')]) }}" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-file-excel me-1"></i> Excel
            </a>
        </div>
    </div>
</div>

<div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb;">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th class="table-th">Applicant</th>
                    <th class="table-th">Email</th>
                    <th class="table-th">Job</th>
                    <th class="table-th">Company</th>
                    <th class="table-th">Status</th>
                    <th class="table-th">Applied</th>
                    <th class="table-th">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($applications as $app)
                    <tr>
                        <td>
                            <strong>{{ $app->user->name }}</strong>
                        </td>
                        <td>{{ $app->user->email }}</td>
                        <td>{{ $app->job->title }}</td>
                        <td>{{ $app->job->company }}</td>
                        <td>
                            <select class="form-select form-select-sm" onchange="updateStatus({{ $app->id }}, this.value)" style="max-width: 150px;">
                                <option value="applied" {{ $app->status == 'applied' ? 'selected' : '' }}>Applied</option>
                                <option value="shortlisted" {{ $app->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                                <option value="interview" {{ $app->status == 'interview' ? 'selected' : '' }}>Interview</option>
                                <option value="hired" {{ $app->status == 'hired' ? 'selected' : '' }}>Hired</option>
                                <option value="rejected" {{ $app->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </td>
                        <td>{{ $app->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.applications.show', $app) }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No applications found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav class="mt-4">
        {{ $applications->links('pagination::bootstrap-5') }}
    </nav>
</div>

@endsection

@section('scripts')
<script>
function updateStatus(applicationId, status) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/admin/applications/${applicationId}/status`;
    
    form.innerHTML = `
        @csrf
        <input type="hidden" name="status" value="${status}">
    `;
    
    document.body.appendChild(form);
    form.submit();
}
</script>
@endsection
