<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use App\Models\Application;
use App\Models\Job;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\View\View;

class DashboardController
{
    public function index(): View
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_users_today' => User::where('role', 'user')->whereDate('created_at', today())->count(),
            'active_jobs' => Job::where('status', 'active')->count(),
            'active_portfolios' => Portfolio::where('status', 'approved')->count(),
            'applications_today' => Application::whereDate('created_at', today())->count(),
            'total_applications' => Application::count(),
            'pending_portfolios' => Portfolio::where('status', 'pending')->count(),
        ];

        $recent_activity = Activity::with('user')
            ->latest()
            ->take(15)
            ->get();

        $job_applications_chart = Application::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(7)
            ->get();

        $user_growth = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('role', 'user')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->take(30)
            ->get();

        $recent_portfolios = Portfolio::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_activity', 'job_applications_chart', 'user_growth', 'recent_portfolios'));
    }
}
