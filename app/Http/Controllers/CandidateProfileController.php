<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CandidateProfile;
use App\Models\CandidateEducation;
use App\Models\CandidateExperience;
use App\Models\CandidateSkill;
use Illuminate\Support\Facades\Storage;

class CandidateProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $profile = $user->candidateProfile ?? new CandidateProfile();
        $educations = $user->candidateEducations;
        $experiences = $user->candidateExperiences;
        $skills = $user->candidateSkills;

        return view('candidate.profile.index', compact('user', 'profile', 'educations', 'experiences', 'skills'));
    }

    public function updatePersonal(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $user->candidateProfile()->updateOrCreate(
            ['user_id' => $user->id],
            $request->except('_token')
        );

        $this->calculateCompletion();

        return redirect()->back()->with('success', 'Personal details updated successfully.');
    }

    public function updateEducation(Request $request)
    {
        $request->validate([
            'education_level.*' => 'required|string',
            'course_name.*' => 'required|string',
            'institute_name.*' => 'required|string',
            'university_board.*' => 'required|string',
            'marks_percentage.*' => 'required|string',
            'passing_year.*' => 'required|integer|digits:4',
        ]);

        $user = auth()->user();
        
        // Simple approach: Delete all and recreate (for prototype/simplicity in this context)
        // Ideally, we should handle updates by ID, but dynamic rows usually imply full replacement or careful ID tracking.
        // Given the request complexity, we'll try to sync or re-create.
        
        // Let's assume the form sends arrays. We will clear existing and re-add.
        $user->candidateEducations()->delete();

        if ($request->has('education_level')) {
            foreach ($request->education_level as $key => $value) {
                $user->candidateEducations()->create([
                    'education_level' => $request->education_level[$key],
                    'course_name' => $request->course_name[$key],
                    'institute_name' => $request->institute_name[$key],
                    'university_board' => $request->university_board[$key],
                    'marks_percentage' => $request->marks_percentage[$key],
                    'passing_year' => $request->passing_year[$key],
                ]);
            }
        }

        $this->calculateCompletion();

        return redirect()->back()->with('success', 'Education details updated successfully.');
    }

    public function updateExperience(Request $request)
    {
        $request->validate([
            'company_name.*' => 'required|string',
            'designation.*' => 'required|string',
            'employment_type.*' => 'required|string',
            'start_date.*' => 'required|date',
            'job_description.*' => 'nullable|string',
        ]);

        $user = auth()->user();
        $user->candidateExperiences()->delete();

        if ($request->has('company_name')) {
            foreach ($request->company_name as $key => $value) {
                $user->candidateExperiences()->create([
                    'company_name' => $request->company_name[$key],
                    'designation' => $request->designation[$key],
                    'employment_type' => $request->employment_type[$key],
                    'start_date' => $request->start_date[$key],
                    'end_date' => $request->end_date[$key] ?? null,
                    'total_years' => $request->total_years[$key] ?? null,
                    'job_description' => $request->job_description[$key] ?? '',
                ]);
            }
        }

        $this->calculateCompletion();

        return redirect()->back()->with('success', 'Experience details updated successfully.');
    }

    public function updateSkills(Request $request)
    {
        $request->validate([
            'skill_name.*' => 'required|string',
            'skill_level.*' => 'required|string',
            'years_of_experience.*' => 'required|string',
        ]);

        $user = auth()->user();
        $user->candidateSkills()->delete();

        if ($request->has('skill_name')) {
            foreach ($request->skill_name as $key => $value) {
                $user->candidateSkills()->create([
                    'skill_name' => $request->skill_name[$key],
                    'skill_level' => $request->skill_level[$key],
                    'years_of_experience' => $request->years_of_experience[$key],
                ]);
            }
        }

        $this->calculateCompletion();

        return redirect()->back()->with('success', 'Skills updated successfully.');
    }

    public function uploadResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $user = auth()->user();

        if ($request->file('resume')) {
            $path = $request->file('resume')->store('resumes'); // Default disk (usually local or public)
            
            $user->candidateProfile()->updateOrCreate(
                ['user_id' => $user->id],
                ['resume_path' => $path]
            );
        }

        $this->calculateCompletion();

        return redirect()->back()->with('success', 'Resume uploaded successfully.');
    }

    private function calculateCompletion()
    {
        $user = auth()->user();
        $percentage = 0;

        // Personal Details (Weight: 40%)
        if ($user->candidateProfile && $user->candidateProfile->first_name && $user->candidateProfile->phone) {
            $percentage += 40;
        }

        // Education (Weight: 20%)
        if ($user->candidateEducations()->count() > 0) {
            $percentage += 20;
        }

        // Experience (Weight: 10%) - Optional but adds to profile
        if ($user->candidateExperiences()->count() > 0) {
            $percentage += 10;
        }

        // Skills (Weight: 10%)
        if ($user->candidateSkills()->count() > 0) {
            $percentage += 10;
        }

        // Resume (Weight: 20%)
        if ($user->candidateProfile && $user->candidateProfile->resume_path) {
            $percentage += 20;
        }

        // Cap at 100
        $percentage = min($percentage, 100);

        $user->candidateProfile()->update(['profile_completion_percentage' => $percentage]);
    }
}
