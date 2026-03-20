<?php

namespace App\Http\Controllers\Admin;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApplicationController
{
    public function index(Request $request): View
    {
        $query = Application::with('user', 'job');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.applications.index', compact('applications'));
    }

    public function show(Application $application): View
    {
        return view('admin.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $application->update(['status' => $request->status]);

        return back()->with('success', 'Application status updated.');
    }

    public function export(Request $request)
    {
        $query = Application::with('user', 'job');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->orderBy('created_at', 'desc')->get();

        $fileName = 'applications_' . now()->format('Y-m-d_H-i-s');
        $format = $request->query('format', 'csv');

        if ($format === 'excel') {
            return $this->exportExcel($applications, $fileName);
        }

        return $this->exportCsv($applications, $fileName);
    }

    private function exportCsv($applications, $fileName)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}.csv\"",
        ];

        $callback = function () use ($applications) {
            $file = fopen('php://output', 'w');

            // Write CSV header
            fputcsv($file, [
                'Applicant Name',
                'Email',
                'Job Title',
                'Company',
                'Status',
                'Applied Date',
                'Notes'
            ]);

            // Write CSV data
            foreach ($applications as $app) {
                fputcsv($file, [
                    $app->user->name,
                    $app->user->email,
                    $app->job->title,
                    $app->job->company,
                    ucfirst($app->status),
                    $app->created_at->format('Y-m-d H:i:s'),
                    $app->notes ?? ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportExcel($applications, $fileName)
    {
        $headers = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => "attachment; filename=\"{$fileName}.xls\"",
        ];

        $callback = function () use ($applications) {
            $file = fopen('php://output', 'w');

            // Write Excel header with tab-separated values
            fputcsv($file, [
                'Applicant Name',
                'Email',
                'Job Title',
                'Company',
                'Status',
                'Applied Date',
                'Notes'
            ], "\t");

            // Write Excel data
            foreach ($applications as $app) {
                fputcsv($file, [
                    $app->user->name,
                    $app->user->email,
                    $app->job->title,
                    $app->job->company,
                    ucfirst($app->status),
                    $app->created_at->format('Y-m-d H:i:s'),
                    $app->notes ?? ''
                ], "\t");
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
