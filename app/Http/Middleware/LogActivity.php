<?php

namespace App\Http\Middleware;

use App\Models\Activity;
use Closure;
use Illuminate\Http\Request;

class LogActivity
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only log successful admin actions
        if (auth()->check() && auth()->user()->role === 'admin' && $response->getStatusCode() < 400) {
            $this->logAction($request);
        }

        return $response;
    }

    private function logAction(Request $request): void
    {
        $action = $this->getActionName($request);
        
        if (!$action) {
            return;
        }

        Activity::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'description' => $this->getDescription($request, $action),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }

    private function getActionName(Request $request): ?string
    {
        $route = $request->route()?->getActionMethod() ?? '';
        
        return match ($route) {
            'approve' => 'portfolio_approved',
            'reject' => 'portfolio_rejected',
            'feature' => 'job_featured',
            'suspend' => 'user_suspended',
            'activate' => 'user_activated',
            'updateStatus' => 'status_updated',
            default => null,
        };
    }

    private function getDescription(Request $request, string $action): string
    {
        return match ($action) {
            'portfolio_approved' => 'Approved a portfolio submission',
            'portfolio_rejected' => 'Rejected a portfolio submission',
            'job_featured' => 'Featured/unfeatured a job posting',
            'user_suspended' => 'Suspended a user account',
            'user_activated' => 'Activated a user account',
            'status_updated' => 'Updated application status',
            default => $action,
        };
    }
}
