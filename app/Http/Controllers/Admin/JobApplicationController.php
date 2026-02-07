<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\JobApplication;

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

        return redirect()->back()->with('success', 'Application updated successfully.');
    }
}
