<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\JobPost;

class PublicJobController extends Controller
{
    public function index()
    {
        $jobs = JobPost::open()->latest()->paginate(9);
        return view('public.jobs.index', compact('jobs'));
    }

    public function show(JobPost $job)
    {
        if ($job->status !== 'Open') {
            abort(404);
        }
        return view('public.jobs.show', compact('job'));
    }
}
