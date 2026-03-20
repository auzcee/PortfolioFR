@extends('admin.layout')

@section('title', 'Jobs Management')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="fas fa-suitcase me-2"></i>Jobs Management</h2>
    </div>
    <div class="col-md-4">
        <div class="btn-group w-100" role="group">
            <a href="{{ route('admin.jobs.index', ['status' => 'active']) }}" class="btn btn-sm {{ request('status') == 'active' ? 'btn-primary' : 'btn-outline-primary' }}">
                Active
            </a>
            <a href="{{ route('admin.jobs.index', ['status' => 'inactive']) }}" class="btn btn-sm {{ request('status') == 'inactive' ? 'btn-secondary' : 'btn-outline-secondary' }}">
                Inactive
            </a>
        </div>
    </div>
</div>

<div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb;">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th class="table-th">Title</th>
                    <th class="table-th">Company</th>
                    <th class="table-th">Location</th>
                    <th class="table-th">Applications</th>
                    <th class="table-th">Featured</th>
                    <th class="table-th">Status</th>
                    <th class="table-th">Posted</th>
                    <th class="table-th">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jobs as $job)
                    <tr>
                        <td><strong>{{ $job->title }}</strong></td>
                        <td>{{ $job->company }}</td>
                        <td>{{ $job->location }}</td>
                        <td>
                            <span class="badge bg-info">{{ $job->applications->count() }} apps</span>
                        </td>
                        <td>
                            @if ($job->is_featured)
                                <span class="badge bg-warning"><i class="fas fa-star"></i> Featured</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge" style="background: {{ $job->status == 'active' ? 'rgba(16, 185, 129, 0.2); color: #10b981;' : 'rgba(107, 114, 128, 0.2); color: #6b7280;' }}">
                                {{ ucfirst($job->status) }}
                            </span>
                        </td>
                        <td>{{ $job->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.jobs.show', $job) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.jobs.feature', $job) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $job->is_featured ? 'btn-warning' : 'btn-outline-warning' }}" title="Toggle Featured">
                                        <i class="fas fa-star"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">No jobs found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav class="mt-4">
        {{ $jobs->links('pagination::bootstrap-5') }}
    </nav>
</div>

@endsection
