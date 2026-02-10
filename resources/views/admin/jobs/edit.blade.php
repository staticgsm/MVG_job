@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Job Post</h1>
        <a href="{{ route('admin.jobs.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.jobs.update', $job) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Job Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $job->title) }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="project_name" class="form-label">Project Name (Optional)</label>
                        <input type="text" class="form-control @error('project_name') is-invalid @enderror" id="project_name" name="project_name" value="{{ old('project_name', $job->project_name) }}">
                        @error('project_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department" value="{{ old('department', $job->department) }}" required>
                        @error('department') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $job->location) }}" required>
                        @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="job_type" class="form-label">Job Type</label>
                        <select class="form-select @error('job_type') is-invalid @enderror" id="job_type" name="job_type" required>
                            <option value="">Select Type</option>
                            <option value="Full-time" {{ old('job_type', $job->job_type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ old('job_type', $job->job_type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Contract" {{ old('job_type', $job->job_type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="Internship" {{ old('job_type', $job->job_type) == 'Internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                        @error('job_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="education_required" class="form-label">Education Required</label>
                        <select class="form-select @error('education_required') is-invalid @enderror" id="education_required" name="education_required[]" multiple size="5" required>
                            @foreach($educationCourses as $course)
                                <option value="{{ $course->name }}" {{ (collect(old('education_required', $job->education_required))->contains($course->name)) ? 'selected' : '' }}>{{ $course->name }} ({{ $course->type }})</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Hold Ctrl/Cmd to select multiple options.</small>
                        @error('education_required') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="experience" class="form-label">Experience</label>
                        <input type="text" class="form-control @error('experience') is-invalid @enderror" id="experience" name="experience" value="{{ old('experience', $job->experience) }}" required>
                        @error('experience') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="salary_range" class="form-label">Salary Range (Optional)</label>
                        <input type="text" class="form-control @error('salary_range') is-invalid @enderror" id="salary_range" name="salary_range" value="{{ old('salary_range', $job->salary_range) }}">
                        @error('salary_range') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Job Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $job->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="deadline_date" class="form-label">Open Till (Deadline)</label>
                        <input type="date" class="form-control @error('deadline_date') is-invalid @enderror" id="deadline_date" name="deadline_date" value="{{ old('deadline_date', optional($job->deadline_date)->format('Y-m-d')) }}">
                        @error('deadline_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="Open" {{ old('status', $job->status) == 'Open' ? 'selected' : '' }}>Open</option>
                            <option value="Closed" {{ old('status', $job->status) == 'Closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="skills_required" class="form-label">Skills Required</label>
                    <select class="form-select @error('skills_required') is-invalid @enderror" id="skills_required" name="skills_required[]" multiple size="5">
                        @foreach($skills as $skill)
                            <option value="{{ $skill->name }}" {{ (collect(old('skills_required', $job->skills_required))->contains($skill->name)) ? 'selected' : '' }}>{{ $skill->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Hold Ctrl/Cmd to select multiple skills.</small>
                        @error('skills_required') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Job Post</button>
            </form>
        </div>
    </div>
</div>
@endsection
