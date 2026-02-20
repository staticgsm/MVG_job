<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;

class PublicJobController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPost::open();

        // Keyword Search
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->keyword.'%')
                    ->orWhere('description', 'like', '%'.$request->keyword.'%')
                    ->orWhere('project_name', 'like', '%'.$request->keyword.'%');
            });
        }

        // Location Filter
        if ($request->filled('location')) {
            $query->where('location', 'like', '%'.$request->location.'%');
        }

        // Job Type Filter
        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        // Skills Filter (JSON Array)
        if ($request->filled('skills') && is_array($request->skills)) {
            $query->where(function ($q) use ($request) {
                foreach ($request->skills as $skill) {
                    $q->orWhereJsonContains('skills_required', $skill);
                }
            });
        }

        // Education Filter (JSON Array)
        if ($request->filled('education') && is_array($request->education)) {
            $query->where(function ($q) use ($request) {
                foreach ($request->education as $edu) {
                    $q->orWhereJsonContains('education_required', $edu);
                }
            });
        }

        $jobs = $query->latest()->paginate(9)->withQueryString();

        $skills = \App\Models\Skill::orderBy('name')->get();
        $educationCourses = \App\Models\EducationCourse::orderBy('name')->get();
        $locations = JobPost::open()->select('location')->distinct()->pluck('location');

        return view('public.jobs.index', compact('jobs', 'skills', 'educationCourses', 'locations'));
    }

    public function show(JobPost $job)
    {
        if ($job->status !== 'Open') {
            abort(404);
        }

        return view('public.jobs.show', compact('job'));
    }
}
