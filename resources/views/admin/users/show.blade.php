@extends('admin.layout')

@section('title', "User: {$user->name}")

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb;">
            <div class="text-center mb-3">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #2563eb, #1e40af); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <h5 class="text-center">{{ $user->name }}</h5>
            <p class="text-center text-muted mb-4">{{ $user->email }}</p>

            <div class="mb-3 pb-3" style="border-bottom: 1px solid #e5e7eb;">
                <small class="text-muted">Role</small>
                <div><span class="badge bg-primary">{{ ucfirst($user->role) }}</span></div>
            </div>

            <div class="mb-3 pb-3" style="border-bottom: 1px solid #e5e7eb;">
                <small class="text-muted">Status</small>
                <div>
                    @if ($user->is_active)
                        <span class="badge" style="background: rgba(16, 185, 129, 0.2); color: #10b981;">Active</span>
                    @else
                        <span class="badge" style="background: rgba(239, 68, 68, 0.2); color: #ef4444;">Inactive</span>
                    @endif
                </div>
            </div>

            <div class="mb-3 pb-3" style="border-bottom: 1px solid #e5e7eb;">
                <small class="text-muted">Member Since</small>
                <div><strong>{{ $user->created_at->format('M d, Y') }}</strong></div>
            </div>

            <div class="mb-3">
                <small class="text-muted">Last Login</small>
                <div>
                    @if ($user->last_login_at)
                        {{ $user->last_login_at->diffForHumans() }}
                    @else
                        Never logged in
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb; margin-bottom: 1.5rem;">
            <h5 class="mb-3">Account Actions</h5>
            <div class="d-flex gap-2">
                @if ($user->is_active)
                    <form action="{{ route('admin.users.suspend', $user) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning" onclick="return confirm('Suspend this user?')">
                            <i class="fas fa-pause me-2"></i> Suspend Account
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.users.activate', $user) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-play me-2"></i> Activate Account
                        </button>
                    </form>
                @endif
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this user permanently?')">
                        <i class="fas fa-trash me-2"></i> Delete User
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb;">
            <h5 class="mb-3">Contact Information</h5>
            <table class="table table-sm table-borderless">
                <tr>
                    <td class="text-muted">Email</td>
                    <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                </tr>
                <tr>
                    <td class="text-muted">Account Created</td>
                    <td>{{ $user->created_at->format('F j, Y \a\t H:i A') }}</td>
                </tr>
                @if ($user->last_login_at)
                    <tr>
                        <td class="text-muted">Last Seen</td>
                        <td>{{ $user->last_login_at->format('F j, Y \a\t H:i A') }}</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div>

@endsection
