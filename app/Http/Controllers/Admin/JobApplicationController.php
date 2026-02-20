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
}
