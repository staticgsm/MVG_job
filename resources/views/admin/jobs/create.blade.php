@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-700">Post New Job</h1>
        <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Listing
        </a>
    </div>

    <div class="card shadow-sm border-0 mb-5">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-base-color"><i class="bi bi-file-earmark-plus me-2"></i>Job Details & Requirements</h6>
        </div>
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('admin.jobs.store') }}" method="POST">
                @csrf
                
                <div class="section-heading mb-4 pb-2 border-bottom">
                    <span class="fw-700 text-dark">Basic Information</span>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="title" class="form-label">Job Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="e.g. Senior Software Engineer" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="website" class="form-label">Company Website (Optional)</label>
                        <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website') }}" placeholder="e.g. https://example.com">
                        @error('website') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="project_name" class="form-label">Project Name</label>
                        <input type="text" class="form-control @error('project_name') is-invalid @enderror" id="project_name" name="project_name" value="{{ old('project_name') }}" placeholder="Enter project name if applicable">
                        @error('project_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department" value="{{ old('department') }}" placeholder="e.g. Information Technology" required>
                        @error('department') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" placeholder="e.g. Pune, Maharashtra" required>
                        @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="section-heading mb-4 mt-2 pb-2 border-bottom">
                    <span class="fw-700 text-dark">Job Classification</span>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="job_type" class="form-label">Job Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('job_type') is-invalid @enderror" id="job_type" name="job_type" required>
                            <option value="">Select Type</option>
                            <option value="Full-time" {{ old('job_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ old('job_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Contract" {{ old('job_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="Internship" {{ old('job_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                        @error('job_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="salary_range" class="form-label">Salary Range</label>
                        <input type="text" class="form-control @error('salary_range') is-invalid @enderror" id="salary_range" name="salary_range" value="{{ old('salary_range') }}" placeholder="e.g. ₹5,00,000 - ₹8,00,000 P.A.">
                        @error('salary_range') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="section-heading mb-4 mt-2 pb-2 border-bottom">
                    <span class="fw-700 text-dark">Requirements</span>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="experience" class="form-label">Experience Required <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('experience') is-invalid @enderror" id="experience" name="experience" value="{{ old('experience') }}" placeholder="e.g. 2-5 Years" required>
                        @error('experience') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="Open" {{ old('status') == 'Open' ? 'selected' : '' }}>Open (Directly visible)</option>
                            <option value="Closed" {{ old('status') == 'Closed' ? 'selected' : '' }}>Closed (Draft)</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="education_required" class="form-label">Education Required <span class="text-danger">*</span></label>
                        <select class="form-select @error('education_required') is-invalid @enderror" id="education_required" name="education_required[]" multiple size="6" required>
                            @foreach($educationCourses as $course)
                                <option value="{{ $course->name }}" {{ (collect(old('education_required'))->contains($course->name)) ? 'selected' : '' }}>{{ $course->name }} ({{ $course->type }})</option>
                            @endforeach
                        </select>
                        <small class="text-muted"><i class="bi bi-info-circle me-1"></i> Hold Ctrl/Cmd to select multiple options.</small>
                        @error('education_required') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="skills_required" class="form-label">Skills Required</label>
                        <select class="form-select @error('skills_required') is-invalid @enderror" id="skills_required" name="skills_required[]" multiple size="6">
                            @foreach($skills as $skill)
                                <option value="{{ $skill->name }}" {{ (collect(old('skills_required'))->contains($skill->name)) ? 'selected' : '' }}>{{ $skill->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted"><i class="bi bi-info-circle me-1"></i> Hold Ctrl/Cmd to select multiple skills.</small>
                        @error('skills_required') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Detailed Job Description <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="8" placeholder="Describe the roles, responsibilities, and requirements..." required>{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="deadline_date" class="form-label">Application Deadline</label>
                        <input type="date" class="form-control @error('deadline_date') is-invalid @enderror" id="deadline_date" name="deadline_date" value="{{ old('deadline_date') }}">
                        @error('deadline_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top">
                    <button type="submit" class="btn btn-base-color px-5 py-2">
                        <i class="bi bi-check2-circle me-2"></i> Create & Publish Job
                    </button>
                    <a href="{{ route('admin.jobs.index') }}" class="btn btn-light px-5 py-2 ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-select[multiple] {
        padding: 5px;
    }
    .form-select[multiple] option {
        padding: 8px 12px;
        border-radius: 4px;
        margin-bottom: 2px;
    }
    .form-select[multiple] option:checked {
        background-color: var(--brand-primary) !important;
        color: white !important;
    }
    .section-heading {
        margin-bottom: 25px;
    }
</style>
@endsection
