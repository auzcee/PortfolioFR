@extends('admin.layout')

@section('title', 'Portfolio Approvals')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="fas fa-briefcase me-2"></i>Portfolio Approvals</h2>
    </div>
    <div class="col-md-4">
        <div class="btn-group" role="group">
            <a href="{{ route('admin.portfolios.index', ['status' => 'pending']) }}" class="btn btn-sm {{ request('status') == 'pending' ? 'btn-primary' : 'btn-outline-primary' }}">
                Pending ({{ App\Models\Portfolio::where('status', 'pending')->count() }})
            </a>
            <a href="{{ route('admin.portfolios.index', ['status' => 'approved']) }}" class="btn btn-sm {{ request('status') == 'approved' ? 'btn-success' : 'btn-outline-success' }}">
                Approved ({{ App\Models\Portfolio::where('status', 'approved')->count() }})
            </a>
            <a href="{{ route('admin.portfolios.index', ['status' => 'rejected']) }}" class="btn btn-sm {{ request('status') == 'rejected' ? 'btn-danger' : 'btn-outline-danger' }}">
                Rejected ({{ App\Models\Portfolio::where('status', 'rejected')->count() }})
            </a>
        </div>
    </div>
</div>

<div class="row">
    @forelse ($portfolios as $portfolio)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="bg-white rounded-2 overflow-hidden" style="border: 1px solid #e5e7eb; transition: all .3s;">
                <!-- Thumbnail -->
                <div style="background: #f3f4f6; height: 200px; overflow: hidden; position: relative;">
                    @if ($portfolio->thumbnail)
                        <img src="{{ $portfolio->thumbnail }}" alt="Portfolio" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #9ca3af; font-size: 3rem;">
                            <i class="fas fa-image"></i>
                        </div>
                    @endif
                </div>

                <!-- Info -->
                <div class="p-3">
                    <div class="mb-2">
                        <strong class="d-block">{{ $portfolio->user->name }}</strong>
                        <small class="text-muted">{{ $portfolio->user->email }}</small>
                    </div>

                    <p class="text-sm mb-2">{{ Str::limit($portfolio->title, 50) }}</p>

                    <div class="mb-3">
                        <span class="badge" style="background: 
                            @if($portfolio->status == 'approved') #10b981
                            @elseif($portfolio->status == 'pending') #f59e0b
                            @else #ef4444
                            @endif
                        ">{{ ucfirst($portfolio->status) }}</span>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.portfolios.show', $portfolio) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-eye"></i> View Details
                        </a>

                        @if ($portfolio->status == 'pending')
                            <form action="{{ route('admin.portfolios.approve', $portfolio) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success w-100">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </form>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $portfolio->id }}">
                                <i class="fas fa-times"></i> Reject
                            </button>

                            <!-- Reject Modal -->
                            <div class="modal fade" id="rejectModal{{ $portfolio->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Reject Portfolio</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('admin.portfolios.reject', $portfolio) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <textarea name="reason" class="form-control" placeholder="Reason for rejection..." rows="4" required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Reject</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-inbox" style="font-size: 3rem; color: #d1d5db;"></i>
            <p class="mt-3 text-muted">No portfolios to review</p>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<nav class="mt-4">
    {{ $portfolios->links('pagination::bootstrap-5') }}
</nav>

@endsection
