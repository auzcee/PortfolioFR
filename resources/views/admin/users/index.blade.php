@extends('admin.layout')

@section('title', 'Users Management')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="fas fa-users me-2"></i>Users Management</h2>
    </div>
    <div class="col-md-4">
        <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Search users..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
        </form>
    </div>
</div>

<div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb;">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th class="table-th">Name</th>
                    <th class="table-th">Email</th>
                    <th class="table-th">Role</th>
                    <th class="table-th">Status</th>
                    <th class="table-th">Last Login</th>
                    <th class="table-th">Joined</th>
                    <th class="table-th">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td><strong>{{ $user->name }}</strong></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge" style="background: rgba(37, 99, 235, 0.2); color: #2563eb;">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td>
                            @if ($user->is_active)
                                <span class="badge" style="background: rgba(16, 185, 129, 0.2); color: #10b981;">Active</span>
                            @else
                                <span class="badge" style="background: rgba(239, 68, 68, 0.2); color: #ef4444;">Inactive</span>
                            @endif
                        </td>
                        <td>
                            @if ($user->last_login_at)
                                {{ $user->last_login_at->diffForHumans() }}
                            @else
                                <span class="text-muted">Never</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-outline-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if ($user->is_active)
                                    <form action="{{ route('admin.users.suspend', $user) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-warning" title="Suspend" onclick="return confirm('Suspend this user?')">
                                            <i class="fas fa-pause"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.users.activate', $user) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Activate">
                                            <i class="fas fa-play"></i>
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Delete this user?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav class="mt-4">
        {{ $users->links('pagination::bootstrap-5') }}
    </nav>
</div>

@endsection
