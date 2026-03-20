@extends('admin.layout')

@section('title', "Application: {$application->user->name}")

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mb-4">
        <div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb; margin-bottom: 1.5rem;">
            <h3>{{ $application->user->name }}</h3>
            <p class="text-muted mb-3">Applied for: <strong>{{ $application->job->title }}</strong> at {{ $application->job->company }}</p>

            <div class="mb-3">
                <strong>Email:</strong>
                <p><a href="mailto:{{ $application->user->email }}">{{ $application->user->email }}</a></p>
            </div>

            <div class="mb-3">
                <strong>Cover Letter:</strong>
                <p style="white-space: pre-wrap; background: #f3f4f6; padding: 1rem; border-radius: 6px;">
                    {{ $application->cover_letter ?? 'No cover letter provided' }}
                </p>
            </div>

            <div class="mb-3">
                <strong>Application Date:</strong>
                <p>{{ $application->created_at->format('F j, Y \a\t H:i A') }}</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb;">
            <h5>Job Details</h5>
            <table class="table table-sm">
                <tr>
                    <td class="text-muted">Position</td>
                    <td>{{ $application->job->title }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Company</td>
                    <td>{{ $application->job->company }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Location</td>
                    <td>{{ $application->job->location }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Salary</td>
                    <td>{{ $application->job->salary }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-md-4">
        <div class="bg-white p-4 rounded-2" style="border: 1px solid #e5e7eb;">
            <h5 class="mb-3">Update Status</h5>
            <form action="{{ route('admin.applications.updateStatus', $application) }}" method="POST">
                @csrf
                <select name="status" class="form-select mb-3">
                    <option value="applied" {{ $application->status == 'applied' ? 'selected' : '' }}>Applied</option>
                    <option value="shortlisted" {{ $application->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                    <option value="interview" {{ $application->status == 'interview' ? 'selected' : '' }}>Interview</option>
                    <option value="hired" {{ $application->status == 'hired' ? 'selected' : '' }}>Hired</option>
                    <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                <button type="submit" class="btn btn-primary w-100">Update Status</button>
            </form>
            
            <hr>
            
            <div>
                <p class="text-muted mb-2"><small>Current Status</small></p>
                <span class="badge" style="background: 
                    @if($application->status == 'hired') rgba(16, 185, 129, 0.2); color: #10b981;
                    @elseif($application->status == 'rejected') rgba(239, 68, 68, 0.2); color: #ef4444;
                    @elseif($application->status == 'interview') rgba(99, 102, 241, 0.2); color: #6366f1;
                    @elseif($application->status == 'shortlisted') rgba(59, 130, 246, 0.2); color: #3b82f6;
                    @else rgba(37, 99, 235, 0.2); color: #2563eb;
                    @endif
                ">
                    {{ ucfirst($application->status) }}
                </span>
            </div>
        </div>
    </div>
</div>

@endsection
