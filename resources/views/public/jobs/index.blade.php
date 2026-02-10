@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-md-3">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Filter Jobs</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('public.jobs.index') }}" method="GET">
                        <!-- Keyword Search -->
                        <div class="mb-3">
                            <label for="keyword" class="form-label">Keywords</label>
                            <input type="text" class="form-control" id="keyword" name="keyword" value="{{ request('keyword') }}" placeholder="Title, Dept, Project...">
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <select class="form-select" id="location" name="location">
                                <option value="">All Locations</option>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc }}" {{ request('location') == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Job Type -->
                        <div class="mb-3">
                            <label for="job_type" class="form-label">Job Type</label>
                            <select class="form-select" id="job_type" name="job_type">
                                <option value="">All Types</option>
                                <option value="Full-time" {{ request('job_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ request('job_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Contract" {{ request('job_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                                <option value="Internship" {{ request('job_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                            </select>
                        </div>

                        <!-- Skills -->
                        <div class="mb-3">
                            <label class="form-label">Skills</label>
                            <div style="max-height: 150px; overflow-y: auto;">
                                @foreach($skills as $skill)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="skills[]" value="{{ $skill->name }}" id="skill_{{ $skill->id }}" {{ in_array($skill->name, request('skills', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="skill_{{ $skill->id }}">
                                            {{ $skill->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Education -->
                        <div class="mb-3">
                            <label class="form-label">Education</label>
                            <div style="max-height: 150px; overflow-y: auto;">
                                @foreach($educationCourses as $edu)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="education[]" value="{{ $edu->name }}" id="edu_{{ $edu->id }}" {{ in_array($edu->name, request('education', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="edu_{{ $edu->id }}">
                                            {{ $edu->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                            <a href="{{ route('public.jobs.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Job List -->
        <div class="col-md-9">
            <h1 class="text-center mb-4">Open Positions</h1>
            <div class="row">
                @forelse($jobs as $job)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm border-0 job-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-secondary">{{ $job->job_code }}</span>
                                    @if($job->deadline_date)
                                         <small class="text-danger fw-bold">Apply by: {{ $job->deadline_date->format('d M') }}</small>
                                    @endif
                                </div>
                                <h5 class="card-title text-primary fw-bold">{{ $job->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $job->department }}</h6>
                                
                                <p class="card-text mb-2">
                                    <i class="bi bi-geo-alt-fill text-secondary"></i> {{ $job->location }} &bull; 
                                    <i class="bi bi-clock-fill text-secondary"></i> {{ $job->job_type }}
                                </p>
                                
                                @if($job->salary_range)
                                    <p class="card-text mb-2 text-success fw-bold">
                                        {{ $job->salary_range }}
                                    </p>
                                @endif

                                @if($job->skills_required && is_array($job->skills_required))
                                    <div class="mb-3">
                                        @foreach(array_slice($job->skills_required, 0, 3) as $skill)
                                            <span class="badge bg-light text-dark border">{{ $skill }}</span>
                                        @endforeach
                                        @if(count($job->skills_required) > 3)
                                            <span class="badge bg-light text-dark border">+{{ count($job->skills_required) - 3 }}</span>
                                        @endif
                                    </div>
                                @endif

                                <a href="{{ route('public.jobs.show', $job) }}" class="btn btn-outline-primary w-100 stretched-link">View Details</a>
                            </div>
                            <div class="card-footer bg-white text-muted small border-top-0">
                                Posted {{ $job->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="alert alert-info">
                            <h4>No jobs found matching your criteria.</h4>
                            <p>Try adjusting your search filters.</p>
                            <a href="{{ route('public.jobs.index') }}" class="btn btn-primary mt-2">View All Jobs</a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
