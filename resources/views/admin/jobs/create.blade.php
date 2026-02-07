@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Post New Job</h1>
        <a href="{{ route('admin.jobs.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.jobs.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Job Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department" value="{{ old('department') }}" required>
                        @error('department') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" required>
                        @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="job_type" class="form-label">Job Type</label>
                        <select class="form-select @error('job_type') is-invalid @enderror" id="job_type" name="job_type" required>
                            <option value="">Select Type</option>
                            <option value="Full-time" {{ old('job_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ old('job_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Contract" {{ old('job_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="Internship" {{ old('job_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                        @error('job_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="eligibility" class="form-label">Eligibility</label>
                        <input type="text" class="form-control @error('eligibility') is-invalid @enderror" id="eligibility" name="eligibility" value="{{ old('eligibility') }}" required>
                        @error('eligibility') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="experience" class="form-label">Experience</label>
                        <input type="text" class="form-control @error('experience') is-invalid @enderror" id="experience" name="experience" value="{{ old('experience') }}" required>
                        @error('experience') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="salary_range" class="form-label">Salary Range (Optional)</label>
                    <input type="text" class="form-control @error('salary_range') is-invalid @enderror" id="salary_range" name="salary_range" value="{{ old('salary_range') }}">
                    @error('salary_range') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Job Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="Open" {{ old('status') == 'Open' ? 'selected' : '' }}>Open</option>
                        <option value="Closed" {{ old('status') == 'Closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Create Job Post</button>
            </form>
        </div>
    </div>
</div>
@endsection
