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
        return view('admin.jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'eligibility' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'job_type' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:Open,Closed',
        ]);

        JobPost::create($request->all());

        return redirect()->route('admin.jobs.index')->with('success', 'Job post created successfully.');
    }

    public function edit(JobPost $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, JobPost $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'eligibility' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'job_type' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:Open,Closed',
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
