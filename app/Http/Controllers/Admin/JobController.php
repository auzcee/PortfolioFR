<?php

namespace App\Http\Controllers\Admin;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobController
{
    public function index(Request $request): View
    {
        $query = Job::with('user', 'applications');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $jobs = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.jobs.index', compact('jobs'));
    }

    public function show(Job $job): View
    {
        $applications = $job->applications()->with('user')->paginate(10);

        return view('admin.jobs.show', compact('job', 'applications'));
    }

    public function feature(Job $job)
    {
        $job->update(['is_featured' => !$job->is_featured]);

        $action = $job->is_featured ? 'featured' : 'unfeatured';

        return back()->with('success', "Job {$action} successfully.");
    }

    public function updateStatus(Request $request, Job $job)
    {
        $job->update(['status' => $request->status]);

        return back()->with('success', 'Job status updated.');
    }
}
