<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidates = User::whereHas('role', function ($query) {
            $query->where('slug', 'candidate');
        })->with('candidateProfile', 'subscription')->paginate(10);

        return view('admin.candidates.index', compact('candidates'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $candidate = User::with([
            'candidateProfile', 
            'candidateEducations', 
            'candidateExperiences', 
            'candidateSkills', 
            'subscription.subscriptionPlan',
            'jobApplications.jobPost'
        ])->findOrFail($id);

        return view('admin.candidates.show', compact('candidate'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $candidate = User::findOrFail($id);
        $candidate->delete();

        return redirect()->route('admin.candidates.index')->with('success', 'Candidate deleted successfully.');
    }
}
