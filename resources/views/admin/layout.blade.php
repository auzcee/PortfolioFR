<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - PortFolioPH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root { --primary: #2563eb; --secondary: #1e40af; --danger: #dc2626; --success: #16a34a; --warning: #ea580c; --dark: #1f2937; --light: #f3f4f6; }
        body { background: #f9fafb; color: #374151; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
        .navbar-admin { background: white; border-bottom: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,.1); }
        .navbar-admin .nav-link { color: #6b7280; transition: all .3s; padding: .5rem 1rem; }
        .navbar-admin .nav-link:hover { color: var(--primary); }
        .sidebar { background: var(--dark); min-height: 100vh; padding: 2rem 0; }
        .sidebar .nav-link { color: #d1d5db; padding: .8rem 1.5rem; margin: .5rem 0; transition: all .3s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(37, 99, 235, .15); color: #60a5fa; border-left: 3px solid #60a5fa; }
        .sidebar .sidebarheading { color: #9ca3af; font-size: .85rem; text-transform: uppercase; font-weight: 600; padding: 1rem 1.5rem; }
        .content-wrapper { min-height: calc(100vh - 60px); }
        .stat-card { background: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 1.5rem; transition: all .3s; }
        .stat-card:hover { box-shadow: 0 10px 25px rgba(0,0,0,.08); transform: translateY(-2px); }
        .stat-card .stat-icon { width: 50px; height: 50px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .stat-card.primary .stat-icon { background: rgba(37, 99, 235, .1); color: var(--primary); }
        .stat-card.success .stat-icon { background: rgba(22, 163, 74, .1); color: var(--success); }
        .stat-card.warning .stat-icon { background: rgba(234, 88, 12, .1); color: var(--warning); }
        .stat-card.danger .stat-icon { background: rgba(220, 38, 38, .1); color: var(--danger); }
        .stat-value { font-size: 1.875rem; font-weight: 700; color: #111827; margin: .5rem 0; }
        .stat-label { font-size: .875rem; color: #6b7280; }
        .stat-change { font-size: .85rem; margin-top: .5rem; }
        .stat-change.positive { color: var(--success); }
        .stat-change.negative { color: var(--danger); }
        .table-th { background: #f3f4f6; font-weight: 600; color: #374151; border: none; }
        .btn-sm { padding: .375rem .75rem; font-size: .85rem; }
        .badge { padding: .35rem .65rem; font-size: .8rem; }
        .alert { border: none; border-left: 4px solid; }
        .alert-success { background: #ecfdf5; border-color: var(--success); }
        .alert-danger { background: #fef2f2; border-color: var(--danger); }
        .chart-container { position: relative; height: 300px; margin: 1rem 0; }
        .modal-header { background: var(--dark); color: white; border: none; }
        .modal-body { padding: 2rem; }
        .form-control, .form-select { border: 1px solid #d1d5db; padding: .75rem; }
        .form-control:focus, .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(37, 99, 235, .1); }
        .btn-primary { background: var(--primary); border: none; padding: .6rem 1.2rem; }
        .btn-primary:hover { background: var(--secondary); }
        .breadcrumb { background: transparent; margin: 0; }
        .breadcrumb-item.active { color: #6b7280; }
        .activity-item { padding: 1rem; border-bottom: 1px solid #e5e7eb; }
        .activity-item:last-child { border-bottom: none; }
        .activity-icon { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .activity-time { color: #9ca3af; font-size: .85rem; }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-admin">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> <strong>PortFolioPH Admin</strong>
            </a>
            <div class="ms-auto">
                <span class="text-muted me-3">{{ auth()->user()->name }}</span>
                <a href="{{ route('admin.logout') }}" class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar" style="width: 250px;">
            <div class="sidebarheading">MENU</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line me-2"></i> Dashboard
            </a>
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users me-2"></i> Users
            </a>
            <a href="{{ route('admin.portfolios.index') }}" class="nav-link {{ request()->routeIs('admin.portfolios.*') ? 'active' : '' }}">
                <i class="fas fa-briefcase me-2"></i> Portfolios
            </a>
            <a href="{{ route('admin.jobs.index') }}" class="nav-link {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}">
                <i class="fas fa-suitcase me-2"></i> Jobs
            </a>
            <a href="{{ route('admin.applications.index') }}" class="nav-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt me-2"></i> Applications
            </a>
        </nav>

        <!-- Main Content -->
        <div class="content-wrapper" style="flex: 1;">
            <main class="p-4">
                <!-- Alerts -->
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    @yield('scripts')
</body>
</html>
