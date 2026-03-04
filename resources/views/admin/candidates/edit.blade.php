@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Candidate: {{ $candidate->name }}</h2>
        <a href="{{ route('admin.candidates.show', $candidate) }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Profile
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.candidates.update', $candidate) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card shadow mb-4">
            <div class="card-header bg-white">
                <ul class="nav nav-tabs card-header-tabs" id="editTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="user-tab" data-bs-toggle="tab" href="#user" role="tab">Account Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="personal-tab" data-bs-toggle="tab" href="#personal" role="tab">Personal Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="education-tab" data-bs-toggle="tab" href="#education" role="tab">Education</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="experience-tab" data-bs-toggle="tab" href="#experience" role="tab"
                           style="{{ ($candidate->candidateProfile->worker_type ?? '') == 'Unskilled' ? 'display:none;' : '' }}">Experience</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="skills-tab" data-bs-toggle="tab" href="#skills" role="tab">Skills</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="docs-tab" data-bs-toggle="tab" href="#docs" role="tab">Documents</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="editTabsContent">
                    
                    {{-- Account Info --}}
                    <div class="tab-pane fade show active" id="user" role="tabpanel">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $candidate->name) }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $candidate->email) }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" name="mobile" value="{{ old('mobile', $candidate->mobile) }}" required>
                            </div>
                        </div>
                    </div>

                    {{-- Personal Details --}}
                    <div class="tab-pane fade" id="personal" role="tabpanel">
                        @php $profile = $candidate->candidateProfile; @endphp
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $profile->first_name ?? '') }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name', $profile->middle_name ?? '') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $profile->last_name ?? '') }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" name="dob" value="{{ old('dob', $profile && $profile->dob ? $profile->dob->format('Y-m-d') : '') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-select" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender', $profile->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $profile->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender', $profile->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select" name="category" required>
                                    <option value="">Select Category</option>
                                    @foreach(['SC', 'ST', 'OBC', 'NT', 'VJNT', 'OPEN'] as $cat)
                                        <option value="{{ $cat }}" {{ old('category', $profile->category ?? '') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Aadhaar Number</label>
                                <input type="text" class="form-control" name="aadhaar_no" value="{{ old('aadhaar_no', $profile->aadhaar_no ?? '') }}" maxlength="14">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">PAN Number</label>
                                <input type="text" class="form-control" name="pan_no" value="{{ old('pan_no', $profile->pan_no ?? '') }}" maxlength="10">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Worker Category</label>
                                <select class="form-select" name="worker_type" id="worker_type_select" required>
                                    <option value="Skilled" {{ old('worker_type', $profile->worker_type ?? '') == 'Skilled' ? 'selected' : '' }}>Skilled</option>
                                    <option value="Unskilled" {{ old('worker_type', $profile->worker_type ?? '') == 'Unskilled' ? 'selected' : '' }}>Unskilled</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" name="address" rows="2" required>{{ old('address', $profile->address ?? '') }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">District</label>
                                <input type="text" class="form-control" name="district" value="{{ old('district', $profile->district ?? '') }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Taluka</label>
                                <input type="text" class="form-control" name="taluka" value="{{ old('taluka', $profile->taluka ?? '') }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">City/Village</label>
                                <input type="text" class="form-control" name="city" value="{{ old('city', $profile->city ?? '') }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">State</label>
                                <input type="text" class="form-control" name="state" value="{{ old('state', $profile->state ?? 'Maharashtra') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Country</label>
                                <input type="text" class="form-control" name="country" value="{{ old('country', $profile->country ?? 'India') }}" required>
                            </div>
                        </div>
                    </div>

                    {{-- Education --}}
                    <div class="tab-pane fade" id="education" role="tabpanel">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Highest Educational Qualification</label>
                            <select class="form-select" name="highest_education">
                                <option value="">Select Highest Education</option>
                                @foreach(['10th', '12th', 'Diploma', 'Graduate', 'Post Graduate', 'Other'] as $edu)
                                    <option value="{{ $edu }}" {{ old('highest_education', $profile->highest_education ?? '') == $edu ? 'selected' : '' }}>{{ $edu }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="education-fields">
                            @foreach($candidate->candidateEducations as $edu)
                                <div class="education-row border p-3 mb-3 rounded position-relative bg-light">
                                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-row"></button>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label small fw-bold">Level</label>
                                            <select class="form-select" name="education_level[]" required>
                                                @foreach(['X', 'XII', 'Diploma', 'Graduation', 'Post Graduation', 'Other'] as $level)
                                                    <option value="{{ $level }}" {{ $edu->education_level == $level ? 'selected' : '' }}>{{ $level }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label small fw-bold">Course</label>
                                            <select class="form-select" name="course_name[]" required>
                                                @foreach($masterCourses as $mc)
                                                    <option value="{{ $mc->name }}" {{ $edu->course_name == $mc->name ? 'selected' : '' }}>{{ $mc->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label small fw-bold">Institute</label>
                                            <input type="text" class="form-control" name="institute_name[]" value="{{ $edu->institute_name }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label small fw-bold">University/Board</label>
                                            <input type="text" class="form-control" name="university_board[]" value="{{ $edu->university_board }}" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label small fw-bold">Marks (%)</label>
                                            <input type="number" step="0.01" min="0" max="100" class="form-control" name="marks_percentage[]" value="{{ $edu->marks_percentage }}" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label small fw-bold">Passing Year</label>
                                            <input type="text" class="form-control" name="passing_year[]" value="{{ $edu->passing_year }}" required>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" id="addEducation">
                            <i class="bi bi-plus-lg"></i> Add More Education
                        </button>
                    </div>

                    {{-- Experience --}}
                    <div class="tab-pane fade" id="experience" role="tabpanel">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Experience Summary</label>
                            <textarea class="form-control" name="experience" rows="2">{{ old('experience', $profile->experience ?? '') }}</textarea>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="has_no_experience" id="has_no_experience" value="1" {{ ($profile->has_no_experience ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="has_no_experience">Fresher (No Experience)</label>
                            </div>
                        </div>

                        <div id="experience-fields">
                            @foreach($candidate->candidateExperiences as $exp)
                                <div class="experience-row border p-3 mb-3 rounded position-relative bg-light">
                                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-row"></button>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label small fw-bold">Company</label>
                                            <input type="text" class="form-control" name="company_name[]" value="{{ $exp->company_name }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label small fw-bold">Designation</label>
                                            <input type="text" class="form-control" name="designation[]" value="{{ $exp->designation }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label small fw-bold">Type</label>
                                            <select class="form-select" name="employment_type[]" required>
                                                @foreach(['Full-time', 'Part-time', 'Internship', 'Contract'] as $type)
                                                    <option value="{{ $type }}" {{ $exp->employment_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label small fw-bold">Start Date</label>
                                            <input type="date" class="form-control" name="start_date[]" value="{{ $exp->start_date ? $exp->start_date->format('Y-m-d') : '' }}" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label small fw-bold">End Date</label>
                                            <input type="date" class="form-control" name="end_date[]" value="{{ $exp->end_date ? $exp->end_date->format('Y-m-d') : '' }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" id="addExperience">
                            <i class="bi bi-plus-lg"></i> Add More Experience
                        </button>
                    </div>

                    {{-- Skills --}}
                    <div class="tab-pane fade" id="skills" role="tabpanel">
                        <div id="skills-fields">
                            @foreach($candidate->candidateSkills as $skill)
                                <div class="skill-row border p-3 mb-3 rounded position-relative bg-light">
                                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-row"></button>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label small fw-bold">Skill Name</label>
                                            <select class="form-select" name="skill_name[]" required>
                                                @foreach($masterSkills as $ms)
                                                    <option value="{{ $ms->name }}" {{ $skill->skill_name == $ms->name ? 'selected' : '' }}>{{ $ms->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label small fw-bold">Level</label>
                                            <select class="form-select" name="skill_level[]" required>
                                                @foreach(['Beginner', 'Intermediate', 'Advanced'] as $level)
                                                    <option value="{{ $level }}" {{ $skill->skill_level == $level ? 'selected' : '' }}>{{ $level }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label small fw-bold">Years of Exp</label>
                                            <input type="text" class="form-control" name="years_of_experience[]" value="{{ $skill->years_of_experience }}" required>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" id="addSkill">
                            <i class="bi bi-plus-lg"></i> Add More Skill
                        </button>
                    </div>

                    {{-- Documents --}}
                    <div class="tab-pane fade" id="docs" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Profile Photo</label>
                                @if($profile && $profile->photo_path)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($profile->photo_path) }}" class="img-thumbnail" style="width: 100px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control" name="photo" accept="image/*">
                                <small class="text-muted">JPG, PNG. Max 2MB.</small>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Resume (PDF)</label>
                                @if($profile && $profile->resume_path)
                                    <div class="mb-2">
                                        <a href="{{ Storage::url($profile->resume_path) }}" target="_blank" class="btn btn-outline-info btn-sm">
                                            <i class="bi bi-file-earmark-pdf"></i> View Current Resume
                                        </a>
                                    </div>
                                @endif
                                <input type="file" class="form-control" name="resume" accept=".pdf">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Aadhaar Document (PDF)</label>
                                @if($profile && $profile->aadhaar_doc_path)
                                    <div class="mb-2">
                                        <a href="{{ Storage::url($profile->aadhaar_doc_path) }}" target="_blank" class="btn btn-outline-info btn-sm">
                                            <i class="bi bi-file-earmark-pdf"></i> View Current Aadhaar
                                        </a>
                                    </div>
                                @endif
                                <input type="file" class="form-control" name="aadhaar_doc" accept=".pdf">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">PAN Card (PDF)</label>
                                @if($profile && $profile->pan_card_path)
                                    <div class="mb-2">
                                        <a href="{{ Storage::url($profile->pan_card_path) }}" target="_blank" class="btn btn-outline-info btn-sm">
                                            <i class="bi bi-file-earmark-pdf"></i> View Current PAN Card
                                        </a>
                                    </div>
                                @endif
                                <input type="file" class="form-control" name="pan_card" accept=".pdf">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer bg-light text-end">
                <button type="submit" class="btn btn-primary px-5">
                    <i class="bi bi-check-circle-fill me-1"></i> Update Candidate Profile
                </button>
            </div>
        </div>
    </form>
</div>

<template id="edu-template">
    <div class="education-row border p-3 mb-3 rounded position-relative bg-light">
        <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-row"></button>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label small fw-bold">Level</label>
                <select class="form-select" name="education_level[]" required>
                    <option value="X">X</option>
                    <option value="XII">XII</option>
                    <option value="Diploma">Diploma</option>
                    <option value="Graduation">Graduation</option>
                    <option value="Post Graduation">Post Graduation</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label small fw-bold">Course</label>
                <select class="form-select" name="course_name[]" required>
                    @foreach($masterCourses as $mc)
                        <option value="{{ $mc->name }}">{{ $mc->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label small fw-bold">Institute</label>
                <input type="text" class="form-control" name="institute_name[]" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label small fw-bold">University/Board</label>
                <input type="text" class="form-control" name="university_board[]" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label small fw-bold">Marks (%)</label>
                <input type="number" step="0.01" min="0" max="100" class="form-control" name="marks_percentage[]" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label small fw-bold">Passing Year</label>
                <input type="text" class="form-control" name="passing_year[]" required>
            </div>
        </div>
    </div>
</template>

<template id="exp-template">
    <div class="experience-row border p-3 mb-3 rounded position-relative bg-light">
        <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-row"></button>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold">Company</label>
                <input type="text" class="form-control" name="company_name[]" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold">Designation</label>
                <input type="text" class="form-control" name="designation[]" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label small fw-bold">Type</label>
                <select class="form-select" name="employment_type[]" required>
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                    <option value="Internship">Internship</option>
                    <option value="Contract">Contract</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label small fw-bold">Start Date</label>
                <input type="date" class="form-control" name="start_date[]" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label small fw-bold">End Date</label>
                <input type="date" class="form-control" name="end_date[]">
            </div>
        </div>
    </div>
</template>

<template id="skill-template">
    <div class="skill-row border p-3 mb-3 rounded position-relative bg-light">
        <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-row"></button>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label small fw-bold">Skill Name</label>
                <select class="form-select" name="skill_name[]" required>
                    @foreach($masterSkills as $ms)
                        <option value="{{ $ms->name }}">{{ $ms->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label small fw-bold">Level</label>
                <select class="form-select" name="skill_level[]" required>
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label small fw-bold">Years of Exp</label>
                <input type="text" class="form-control" name="years_of_experience[]" required>
            </div>
        </div>
    </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dynamic Rows Logic
    function setupDynamicRows(btnId, containerId, templateId) {
        const btn = document.getElementById(btnId);
        const container = document.getElementById(containerId);
        const template = document.getElementById(templateId);

        if(!btn || !container || !template) return;

        btn.addEventListener('click', function() {
            const clone = template.content.cloneNode(true);
            container.appendChild(clone);
        });

        container.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.border').remove();
            }
        });
    }

    setupDynamicRows('addEducation', 'education-fields', 'edu-template');
    setupDynamicRows('addExperience', 'experience-fields', 'exp-template');
    setupDynamicRows('addSkill', 'skills-fields', 'skill-template');

    // Worker Type & Fresher logic
    const workerType = document.getElementById('worker_type_select');
    const expTab = document.getElementById('experience-tab');
    const fresherCheck = document.getElementById('has_no_experience');
    const expFields = document.getElementById('experience-fields');
    const addExpBtn = document.getElementById('addExperience');

    function updateExpVisibility() {
        if (workerType.value === 'Unskilled') {
            expTab.style.display = 'none';
        } else {
            expTab.style.display = 'block';
        }
    }

    function toggleExpInputs() {
        if(!expFields) return;
        const inputs = expFields.querySelectorAll('input, select');
        if (fresherCheck.checked) {
            expFields.style.opacity = '0.5';
            addExpBtn.disabled = true;
            inputs.forEach(i => i.disabled = true);
        } else {
            expFields.style.opacity = '1';
            addExpBtn.disabled = false;
            inputs.forEach(i => i.disabled = false);
        }
    }

    if(workerType) workerType.addEventListener('change', updateExpVisibility);
    if(fresherCheck) fresherCheck.addEventListener('change', toggleExpInputs);
    
    toggleExpInputs(); // Initial check
});
</script>

@endsection
