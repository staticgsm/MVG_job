<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\User;
use App\Models\JobNotification;
use App\Notifications\NewJobNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class JobPostController extends Controller
{
    public function index()
    {
        $jobs = JobPost::latest()->paginate(10);

        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        $skills = \App\Models\Skill::all();
        $educationCourses = \App\Models\EducationCourse::all();

        return view('admin.jobs.create', compact('skills', 'educationCourses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'project_name' => 'nullable|string|max:255',
            'department' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'eligibility' => 'nullable|string|max:255',
            'education_required' => 'required|array',
            'education_required.*' => 'string|exists:education_courses,name',
            'skills_required' => 'nullable|array',
            'skills_required.*' => 'string|exists:skills,name',
            'experience' => 'required|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'job_type' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:Open,Closed',
            'deadline_date' => 'nullable|date|after:today',
            'positions' => 'required|integer|min:1',
        ]);

        $job = JobPost::create($request->all());

        // Notify Eligible Candidates (Active Subscribers)
        $eligibleCandidates = User::whereHas('role', function ($query) {
            $query->where('slug', 'candidate');
        })->whereHas('subscription', function ($query) {
            $query->where('status', 'active')
                  ->where('end_date', '>=', now());
        })->get();

        foreach ($eligibleCandidates as $candidate) {
            try {
                Notification::send($candidate, new NewJobNotification($job));
                
                JobNotification::create([
                    'job_post_id' => $job->id,
                    'user_id' => $candidate->id,
                    'status' => 'sent',
                ]);
            } catch (\Exception $e) {
                JobNotification::create([
                    'job_post_id' => $job->id,
                    'user_id' => $candidate->id,
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                ]);
            }
        }

        return redirect()->route('admin.jobs.index')->with('success', 'Job post created successfully and notifications sent to eligible candidates.');
    }

    public function edit(JobPost $job)
    {
        $skills = \App\Models\Skill::all();
        $educationCourses = \App\Models\EducationCourse::all();

        return view('admin.jobs.edit', compact('job', 'skills', 'educationCourses'));
    }

    public function update(Request $request, JobPost $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'project_name' => 'nullable|string|max:255',
            'department' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'eligibility' => 'nullable|string|max:255',
            'education_required' => 'required|array',
            'education_required.*' => 'string|exists:education_courses,name',
            'skills_required' => 'nullable|array',
            'skills_required.*' => 'string|exists:skills,name',
            'experience' => 'required|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'job_type' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:Open,Closed',
            'deadline_date' => 'nullable|date|after:today',
            'positions' => 'required|integer|min:1',
        ]);

        $job->update($request->all());

        return redirect()->route('admin.jobs.index')->with('success', 'Job post updated successfully.');
    }

    public function notifications(JobPost $job)
    {
        $notifications = JobNotification::where('job_post_id', $job->id)
            ->with('user')
            ->latest()
            ->paginate(20);

        return view('admin.jobs.notifications', compact('job', 'notifications'));
    }

    public function destroy(JobPost $job)
    {
        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job post deleted successfully.');
    }
}
