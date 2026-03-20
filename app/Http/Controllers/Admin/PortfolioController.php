<?php

namespace App\Http\Controllers\Admin;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController
{
    public function index(Request $request): View
    {
        $status = $request->get('status', 'pending');
        
        $portfolios = Portfolio::with('user')
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('admin.portfolios.index', compact('portfolios', 'status'));
    }

    public function show(Portfolio $portfolio): View
    {
        return view('admin.portfolios.show', compact('portfolio'));
    }

    public function approve(Portfolio $portfolio)
    {
        $portfolio->update(['status' => 'approved', 'reviewed_at' => now()]);

        return back()->with('success', 'Portfolio approved successfully.');
    }

    public function reject(Request $request, Portfolio $portfolio)
    {
        $portfolio->update([
            'status' => 'rejected',
            'rejection_reason' => $request->reason,
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Portfolio rejected.');
    }
}
