<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\JobApplication;

class JobApplicationController extends Controller
{
    public function store(Request $request, JobPost $job)
    {
        $user = auth()->user();

        // 1. Check if user is a candidate
        if (!$user->hasRole('candidate')) {
            return redirect()->back()->with('error', 'Only candidates can apply for jobs.');
        }

        // 2. Check if already applied
        if ($job->applications()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You have already applied for this job.');
        }

        // 3. Check Profile Completion
        if (($user->candidateProfile->profile_completion_percentage ?? 0) < 100) {
            return redirect()->route('candidate.profile.index')->with('error', 'Please complete your profile to apply.');
        }

        // 4. Check Subscription (Optional: based on requirement)
        // if (!($user->candidateProfile->has_active_subscription ?? false)) {
        //     return redirect()->route('candidate.subscription.index')->with('error', 'You need an active subscription to apply.');
        // }

        // Create Application
        $application = JobApplication::create([
            'job_id' => $job->id,
            'user_id' => $user->id,
            'status' => 'Applied',
            'applied_at' => now(),
        ]);

        $user->notify(new \App\Notifications\JobApplicationSubmitted($application));

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }

    public function candidateIndex()
    {
        $applications = auth()->user()->jobApplications()->with('job')->latest()->get();
        return view('candidate.applications.index', compact('applications'));
    }

    public function destroy(JobApplication $application)
    {
        if ($application->user_id !== auth()->id()) {
            abort(403);
        }

        if ($application->status !== 'Applied') {
            return redirect()->back()->with('error', 'You can only cancel applications that are pending review.');
        }

        $application->delete();

        return redirect()->back()->with('success', 'Application cancelled successfully.');
    }
}
