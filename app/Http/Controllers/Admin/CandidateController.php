<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Skill;
use App\Models\EducationCourse;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::whereHas('role', function ($q) {
            $q->where('slug', 'candidate');
        });

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('mobile', 'LIKE', "%{$search}%");
            });
        }

        // Filter by Subscription
        if ($request->filled('subscription')) {
            if ($request->subscription == 'active') {
                $query->whereHas('subscription');
            } elseif ($request->subscription == 'inactive') {
                $query->whereDoesntHave('subscription');
            }
        }

        // Filter by Worker Type
        if ($request->filled('worker_type')) {
            $type = $request->worker_type;
            $query->whereHas('candidateProfile', function($q) use ($type) {
                $q->where('worker_type', $type);
            });
        }

        $candidates = $query->with(['candidateProfile', 'subscription.subscriptionPlan'])
                            ->latest()
                            ->paginate(10)
                            ->withQueryString();

        // Statistics
        $stats = [
            'total' => User::whereHas('role', function($q){ $q->where('slug', 'candidate'); })->count(),
            'subscribed' => User::whereHas('role', function($q){ $q->where('slug', 'candidate'); })
                                ->whereHas('subscription')->count(),
            'new_today' => User::whereHas('role', function($q){ $q->where('slug', 'candidate'); })
                               ->whereDate('created_at', today())->count(),
        ];

        return view('admin.candidates.index', compact('candidates', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $candidate = User::with([
            'candidateProfile',
            'candidateEducations',
            'candidateExperiences',
            'candidateSkills'
        ])->findOrFail($id);

        $masterSkills = Skill::all();
        $masterCourses = EducationCourse::all();

        return view('admin.candidates.edit', compact('candidate', 'masterSkills', 'masterCourses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $candidate = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => 'required|string|max:20',
            
            // Profile fields
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'required|string',
            'category' => 'required|string',
            'phone' => 'required|string|max:20',
            'worker_type' => 'required|string|in:Skilled,Unskilled',
            'address' => 'required|string',
            'district' => 'required|string|max:255',
            'taluka' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'resume' => 'nullable|mimes:pdf|max:2048',
            'aadhaar_no' => 'nullable|string|max:14',
            'aadhaar_doc' => 'nullable|mimes:pdf|max:2048',
            'pan_no' => 'nullable|string|max:10',
            'pan_card' => 'nullable|mimes:pdf|max:2048',

            // Education (simplified validation for batch update)
            'education_level.*' => 'required|string',
            'marks_percentage.*' => 'required|numeric|min:0|max:100',

            // Experience
            'company_name.*' => 'required|string',
        ]);

        // 1. Update User
        $candidate->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);

        // 2. Update/Create Profile
        $profileData = $request->only([
            'first_name', 'middle_name', 'last_name', 'dob', 'gender', 'category', 'phone',
            'address', 'district', 'taluka', 'city', 'state', 'country', 
            'worker_type', 'aadhaar_no', 'highest_education', 'experience', 'has_no_experience', 'pan_no'
        ]);

        if ($request->hasFile('photo')) {
            if ($candidate->candidateProfile && $candidate->candidateProfile->photo_path) {
                Storage::disk('public')->delete($candidate->candidateProfile->photo_path);
            }
            $profileData['photo_path'] = $request->file('photo')->store('profile_photos', 'public');
        }

        if ($request->hasFile('resume')) {
            if ($candidate->candidateProfile && $candidate->candidateProfile->resume_path) {
                Storage::disk('local')->delete($candidate->candidateProfile->resume_path);
            }
            $profileData['resume_path'] = $request->file('resume')->store('resumes');
        }

        if ($request->hasFile('aadhaar_doc')) {
            if ($candidate->candidateProfile && $candidate->candidateProfile->aadhaar_doc_path) {
                Storage::disk('local')->delete($candidate->candidateProfile->aadhaar_doc_path);
            }
            $profileData['aadhaar_doc_path'] = $request->file('aadhaar_doc')->store('documents');
        }

        if ($request->hasFile('pan_card')) {
            if ($candidate->candidateProfile && $candidate->candidateProfile->pan_card_path) {
                Storage::disk('local')->delete($candidate->candidateProfile->pan_card_path);
            }
            $profileData['pan_card_path'] = $request->file('pan_card')->store('documents');
        }

        $candidate->candidateProfile()->updateOrCreate(
            ['user_id' => $candidate->id],
            $profileData
        );

        // 3. Update Education
        $candidate->candidateEducations()->delete();
        if ($request->has('education_level')) {
            foreach ($request->education_level as $key => $value) {
                $candidate->candidateEducations()->create([
                    'education_level' => $request->education_level[$key],
                    'course_name' => $request->course_name[$key],
                    'institute_name' => $request->institute_name[$key],
                    'university_board' => $request->university_board[$key],
                    'marks_percentage' => $request->marks_percentage[$key],
                    'passing_year' => $request->passing_year[$key],
                ]);
            }
        }

        // 4. Update Experience
        $candidate->candidateExperiences()->delete();
        if (!$request->has('has_no_experience') && $request->has('company_name')) {
            foreach ($request->company_name as $key => $value) {
                $candidate->candidateExperiences()->create([
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

        // 5. Update Skills
        $candidate->candidateSkills()->delete();
        if ($request->has('skill_name')) {
            foreach ($request->skill_name as $key => $value) {
                $candidate->candidateSkills()->create([
                    'skill_name' => $request->skill_name[$key],
                    'skill_level' => $request->skill_level[$key],
                    'years_of_experience' => $request->years_of_experience[$key],
                ]);
            }
        }

        $this->calculateCompletion($candidate);

        return redirect()->route('admin.candidates.show', $candidate->id)->with('success', 'Candidate profile updated successfully.');
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
            'jobApplications.jobPost',
            'payments.subscriptionPlan',
        ])->findOrFail($id);

        $subscriptionPlans = SubscriptionPlan::where('is_active', true)->get();

        return view('admin.candidates.show', compact('candidate', 'subscriptionPlans'));
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

    private function calculateCompletion(User $user)
    {
        $percentage = 0;

        // Personal Details (Weight: 40%)
        if ($user->candidateProfile && $user->candidateProfile->first_name && $user->candidateProfile->phone) {
            $percentage += 40;
        }

        // Education (Weight: 20%)
        if ($user->candidateEducations()->count() > 0) {
            $percentage += 20;
        }

        // Experience (Weight: 10%)
        $hasExperience = $user->candidateExperiences()->count() > 0 || ($user->candidateProfile->has_no_experience ?? false);
        if ($hasExperience) {
            $percentage += 10;
        }

        // Skills (Weight: 10%)
        if ($user->candidateSkills()->count() > 0) {
            $percentage += 10;
        }

        // Resume (Weight: 20%)
        if ($user->candidateProfile && $user->candidateProfile->resume_path) {
            $percentage += 15;
        }

        // PAN Card (Weight: 5%)
        if ($user->candidateProfile && $user->candidateProfile->pan_card_path) {
            $percentage += 5;
        }

        // Cap at 100
        $percentage = min($percentage, 100);

        $user->candidateProfile()->update(['profile_completion_percentage' => $percentage]);
    }
}
