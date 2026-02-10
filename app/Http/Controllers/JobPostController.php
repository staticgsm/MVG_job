<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\JobPost;

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
        ]);

        JobPost::create($request->all());

        return redirect()->route('admin.jobs.index')->with('success', 'Job post created successfully.');
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
        ]);

        $job->update($request->all());

        return redirect()->route('admin.jobs.index')->with('success', 'Job post updated successfully.');
    }

    public function destroy(JobPost $job)
    {
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'Job post deleted successfully.');
    }
}
