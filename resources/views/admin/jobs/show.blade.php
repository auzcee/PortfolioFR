@extends('admin.layout')

@section('title', "Job: {$job->title}")

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mb-4">
        <div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb; margin-bottom: 1.5rem;">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h2>{{ $job->title }}</h2>
                    <p class="text-muted mb-0">{{ $job->company }} • {{ $job->location }}</p>
                </div>
                <div>
                    @if ($job->is_featured)
                        <span class="badge bg-warning"><i class="fas fa-star"></i> Featured</span>
                    @endif
                    <span class="badge" style="background: {{ $job->status == 'active' ? 'rgba(16, 185, 129, 0.2); color: #10b981;' : 'rgba(107, 114, 128, 0.2); color: #6b7280;' }}">
                        {{ ucfirst($job->status) }}
                    </span>
                </div>
            </div>

            <div class="mb-3 pb-3" style="border-bottom: 1px solid #e5e7eb;">
                <strong>Salary:</strong> {{ $job->salary }}
            </div>

            <div>
                <h5>Description</h5>
                <p>{{ $job->description }}</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb;">
            <h5 class="mb-3"><i class="fas fa-file-alt me-2"></i>Applications ({{ $applications->total() }})</h5>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="table-th">Applicant</th>
                            <th class="table-th">Status</th>
                            <th class="table-th">Applied</th>
                            <th class="table-th">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($applications as $app)
                            <tr>
                                <td>{{ $app->user->name }}</td>
                                <td>
                                    <span class="badge" style="background: 
                                        @if($app->status == 'hired') rgba(16, 185, 129, 0.2); color: #10b981;
                                        @elseif($app->status == 'rejected') rgba(239, 68, 68, 0.2); color: #ef4444;
                                        @else rgba(37, 99, 235, 0.2); color: #2563eb;
                                        @endif
                                    ">{{ ucfirst($app->status) }}</span>
                                </td>
                                <td>{{ $app->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.applications.show', $app) }}" class="btn btn-sm btn-outline-info">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No applications yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $applications->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <div class="col-md-4">
        <div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb; margin-bottom: 1.5rem;">
            <h5>Job Actions</h5>
            <form action="{{ route('admin.jobs.feature', $job) }}" method="POST" class="mb-2">
                @csrf
                <button type="submit" class="btn {{ $job->is_featured ? 'btn-warning' : 'btn-outline-warning' }} w-100">
                    <i class="fas fa-star me-2"></i> {{ $job->is_featured ? 'Unfeature' : 'Feature' }}
                </button>
            </form>

            <form action="{{ route('admin.jobs.updateStatus', $job) }}" method="POST">
                @csrf
                <select name="status" class="form-select mb-2" onchange="this.form.submit()">
                    <option value="active" {{ $job->status == 'active' ? 'selected' : '' }}>Set Active</option>
                    <option value="inactive" {{ $job->status == 'inactive' ? 'selected' : '' }}>Set Inactive</option>
                    <option value="filled" {{ $job->status == 'filled' ? 'selected' : '' }}>Mark as Filled</option>
                </select>
            </form>
        </div>

        <div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb;">
            <h6 class="mb-3">Job Details</h6>
            <table class="table table-sm table-borderless">
                <tr>
                    <td class="text-muted">Posted by</td>
                    <td><strong>{{ $job->user->name ?? 'Admin' }}</strong></td>
                </tr>
                <tr>
                    <td class="text-muted">Posted on</td>
                    <td>{{ $job->created_at->format('M d, Y') }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Total Views</td>
                    <td><strong>—</strong></td>
                </tr>
            </table>
        </div>
    </div>
</div>

@endsection
