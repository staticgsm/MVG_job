<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobPost;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index(JobPost $job)
    {
        $applications = $job->applications()->with('user.candidateProfile')->latest()->paginate(10);

        return view('admin.jobs.applications.index', compact('job', 'applications'));
    }

    public function update(Request $request, JobApplication $application)
    {
        $request->validate([
            'status' => 'required|in:Applied,Shortlisted,Rejected,Interview Scheduled',
            'remarks' => 'nullable|string',
        ]);

        $application->update([
            'status' => $request->status,
            'remarks' => $request->remarks,
        ]);

        $application->user->notify(new \App\Notifications\ApplicationStatusChanged($application));

        return redirect()->back()->with('success', 'Application updated successfully.');
    }

    public function indexAll()
    {
        $applications = JobApplication::with('jobPost', 'user.candidateProfile')
            ->latest()
            ->paginate(15);

        return view('admin.applications.index', compact('applications'));
    }

    public function downloadResume(\App\Models\JobApplication $application)
    {
        if (! $application->user->candidateProfile || ! $application->user->candidateProfile->resume_path) {
            return redirect()->back()->with('error', 'No resume found for this applicant.');
        }

        return \Illuminate\Support\Facades\Storage::download($application->user->candidateProfile->resume_path);
    }

    public function viewResume(\App\Models\JobApplication $application)
    {
        if (! $application->user->candidateProfile || ! $application->user->candidateProfile->resume_path) {
            return redirect()->back()->with('error', 'No resume found for this applicant.');
        }

        return \Illuminate\Support\Facades\Storage::response($application->user->candidateProfile->resume_path);
    }

    public function export(Request $request)
    {
        $query = JobApplication::with(['jobPost', 'user.candidateProfile']);

        if ($request->filled('job_id')) {
            $query->where('job_id', $request->job_id);
        }

        $applications = $query->latest()->get();

        $filename = "applications_export_" . date('Y-m-d_H-i-s') . ".csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($applications) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Sr No', 'Job Code', 'Job Title', 'Candidate Name', 'Email', 'Mobile', 'Applied On', 'Status', 'Remarks']);

            foreach ($applications as $key => $app) {
                fputcsv($file, [
                    $key + 1,
                    $app->jobPost->job_code ?? 'N/A',
                    $app->jobPost->title ?? 'N/A',
                    $app->user->name,
                    $app->user->email,
                    $app->user->mobile,
                    $app->created_at->format('d M Y'),
                    $app->status,
                    $app->remarks
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
