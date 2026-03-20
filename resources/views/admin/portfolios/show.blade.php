@extends('admin.layout')

@section('title', "Portfolio: {$portfolio->title}")

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('admin.portfolios.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb;">
            @if ($portfolio->thumbnail)
                <img src="{{ $portfolio->thumbnail }}" alt="Thumbnail" style="width: 100%; border-radius: 8px; margin-bottom: 1rem;">
            @else
                <div style="background: #f3f4f6; height: 200px; border-radius: 8px; margin-bottom: 1rem; display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 2rem;">
                    <i class="fas fa-image"></i>
                </div>
            @endif

            <div class="mb-3">
                <small class="text-muted">Status</small>
                <div>
                    <span class="badge" style="background: {{ $portfolio->status == 'approved' ? 'rgba(16, 185, 129, 0.2); color: #10b981;' : ($portfolio->status == 'pending' ? 'rgba(245, 158, 11, 0.2); color: #f59e0b;' : 'rgba(239, 68, 68, 0.2); color: #ef4444;') }}">
                        {{ ucfirst($portfolio->status) }}
                    </span>
                </div>
            </div>

            <div class="mb-3">
                <small class="text-muted">User</small>
                <div><strong>{{ $portfolio->user->name }}</strong></div>
            </div>

            <div class="mb-3">
                <small class="text-muted">Submitted</small>
                <div>{{ $portfolio->created_at->format('M d, Y H:i') }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb; margin-bottom: 1.5rem;">
            <h3>{{ $portfolio->title }}</h3>
            <p class="text-muted mb-4">{{ $portfolio->description }}</p>

            <div>
                <h6>Skills</h6>
                @if ($portfolio->skills)
                    @foreach (explode(',', $portfolio->skills) as $skill)
                        <span class="badge bg-info me-1">{{ trim($skill) }}</span>
                    @endforeach
                @else
                    <span class="text-muted">No skills listed</span>
                @endif
            </div>
        </div>

        @if ($portfolio->status == 'pending')
            <div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb;">
                <h5 class="mb-3">Review Actions</h5>
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('admin.portfolios.approve', $portfolio) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100" onclick="return confirm('Approve this portfolio?')">
                                <i class="fas fa-check me-2"></i> Approve Portfolio
                            </button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#rejectModal">
                            <i class="fas fa-times me-2"></i> Reject Portfolio
                        </button>

                        <!-- Reject Modal -->
                        <div class="modal fade" id="rejectModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Reject Portfolio</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('admin.portfolios.reject', $portfolio) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <label class="form-label">Reason for rejection</label>
                                            <textarea name="reason" class="form-control" rows="4" placeholder="Provide constructive feedback..." required></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Reject</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif ($portfolio->status == 'rejected')
            <div class="alert alert-danger">
                <strong><i class="fas fa-times-circle me-2"></i>Rejection Reason:</strong>
                <p class="mb-0 mt-2">{{ $portfolio->rejection_reason }}</p>
            </div>
        @endif
    </div>
</div>

@endsection
