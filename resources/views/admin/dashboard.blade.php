@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="mb-0"><i class="fas fa-chart-line me-2"></i>Dashboard</h2>
        <p class="text-muted">Welcome back, {{ auth()->user()->name }}!</p>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card primary">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Total Users</div>
                    <div class="stat-value">{{ $stats['total_users'] }}</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i> {{ $stats['total_users_today'] }} today
                    </div>
                </div>
                <div class="stat-icon"><i class="fas fa-users"></i></div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="stat-card success">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Active Jobs</div>
                    <div class="stat-value">{{ $stats['active_jobs'] }}</div>
                    <div class="stat-change">Seeking candidates</div>
                </div>
                <div class="stat-icon"><i class="fas fa-briefcase"></i></div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="stat-card warning">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Applications Today</div>
                    <div class="stat-value">{{ $stats['applications_today'] }}</div>
                    <div class="stat-change">{{ $stats['total_applications'] }} total</div>
                </div>
                <div class="stat-icon"><i class="fas fa-file-alt"></i></div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="stat-card danger">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Pending Reviews</div>
                    <div class="stat-value">{{ $stats['pending_portfolios'] }}</div>
                    <div class="stat-change">Portfolios awaiting approval</div>
                </div>
                <div class="stat-icon"><i class="fas fa-clock"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Chart -->
    <div class="col-lg-8 mb-4">
        <div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb;">
            <h5 class="mb-3"><i class="fas fa-chart-bar me-2"></i>User Growth (Last 30 days)</h5>
            <div class="chart-container">
                <canvas id="userGrowthChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="col-lg-4 mb-4">
        <div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb;">
            <h5 class="mb-3"><i class="fas fa-history me-2"></i>Recent Activity</h5>
            <div style="max-height: 400px; overflow-y: auto;">
                @forelse ($recent_activity as $activity)
                    <div class="activity-item">
                        <div class="d-flex align-items-start">
                            <div class="activity-icon" style="background: rgba(37, 99, 235, 0.1); color: #2563eb;">
                                <i class="fas fa-dot-circle"></i>
                            </div>
                            <div style="flex: 1; margin-left: 1rem;">
                                <small class="d-block"><strong>{{ $activity->action }}</strong></small>
                                <small class="d-block text-muted">{{ $activity->description }}</small>
                                <small class="activity-time">{{ $activity->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted py-4">No activities yet</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Recent Portfolios -->
<div class="row">
    <div class="col-12">
        <div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb;">
            <h5 class="mb-3"><i class="fas fa-briefcase me-2"></i>Recent Portfolio Submissions</h5>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="table-th">User</th>
                            <th class="table-th">Title</th>
                            <th class="table-th">Status</th>
                            <th class="table-th">Submitted</th>
                            <th class="table-th">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recent_portfolios as $portfolio)
                            <tr>
                                <td>
                                    <strong>{{ $portfolio->user->name }}</strong>
                                </td>
                                <td>{{ Str::limit($portfolio->title, 30) }}</td>
                                <td>
                                    <span class="badge" style="background: 
                                        @if($portfolio->status == 'approved') #10b981
                                        @elseif($portfolio->status == 'pending') #f59e0b
                                        @else #ef4444
                                        @endif
                                    ">{{ ucfirst($portfolio->status) }}</span>
                                </td>
                                <td>{{ $portfolio->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.portfolios.show', $portfolio) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No portfolios yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('userGrowthChart').getContext('2d');
    const data = {
        labels: [
            @foreach ($user_growth as $point)
                '{{ \Carbon\Carbon::parse($point->date)->format('M d') }}',
            @endforeach
        ],
        datasets: [{
            label: 'New Users',
            data: [
                @foreach ($user_growth as $point)
                    {{ $point->count }},
                @endforeach
            ],
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37, 99, 235, 0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#2563eb',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
        }]
    };

    new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
