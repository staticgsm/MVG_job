@extends('layouts.frontend')

@section('title', 'Career Opportunities - MVGC Services Private Limited')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/jobs.css') }}">
<style>
    .bg-light-purple { background-color: #f3e5f5; color: #7b1fa2; }
    .bg-light-blue { background-color: #e3f2fd; color: #1976d2; }
    .bg-light-orange { background-color: #fff3e0; color: #ef6c00; }
    .bg-light-green { background-color: #e8f5e9; color: #2e7d32; }
</style>
@endsection

@section('content')
<!-- Search Hero Section -->
<section class="jobs-hero">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <span class="fs-15 text-white opacity-7 fw-700 text-uppercase mb-10px d-block">Find your next career move</span>
                <h1 class="alt-font fw-700 mb-0">Explore Career Opportunities</h1>
            </div>
        </div>
    </div>
</section>

<!-- Search Area -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="search-container">
                <form action="{{ route('public.jobs.index') }}" method="GET">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-5">
                            <div class="search-input-wrapper border-end">
                                <i class="bi bi-search"></i>
                                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Job title, department, or keywords...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="search-input-wrapper">
                                <i class="bi bi-geo-alt"></i>
                                <input type="text" name="location_text" value="{{ request('location') }}" placeholder="City or location...">
                            </div>
                        </div>
                        <div class="col-md-3 text-end px-2">
                            <button type="submit" class="btn btn-medium btn-base-color btn-rounded w-100 fw-700 btn-box-shadow">Search Jobs</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="py-5 mt-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-3">
                <div class="job-filter-sidebar mb-4">
                    <form action="{{ route('public.jobs.index') }}" method="GET">
                        <div class="filter-title">
                            <i class="bi bi-sliders"></i> Filters
                        </div>

                        <!-- Job Type -->
                        <div class="mb-4">
                            <label class="fs-14 fw-700 text-dark-gray mb-3 d-block uppercase small">Job Type</label>
                            @foreach(['Full-time', 'Part-time', 'Contract', 'Internship'] as $type)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="job_types[]" value="{{ $type }}" id="type_{{ $type }}" {{ in_array($type, request('job_types', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label fs-14 text-medium-gray" for="type_{{ $type }}">{{ $type }}</label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Location Dropdown -->
                        <div class="mb-4">
                            <label class="fs-14 fw-700 text-dark-gray mb-3 d-block uppercase small">Location</label>
                            <select class="form-select fs-14 text-medium-gray border-radius-10px border-color-extra-light-gray" name="location">
                                <option value="">Select Location</option>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc }}" {{ request('location') == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Skills -->
                        <div class="mb-4">
                            <label class="fs-14 fw-700 text-dark-gray mb-3 d-block uppercase small">Skills Required</label>
                            <div style="max-height: 200px; overflow-y: auto;" class="custom-scrollbar">
                                @foreach($skills as $skill)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="skills[]" value="{{ $skill->name }}" id="skill_{{ $skill->id }}" {{ in_array($skill->name, request('skills', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label fs-14 text-medium-gray" for="skill_{{ $skill->id }}">{{ $skill->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-3">
                            <button type="submit" class="btn btn-very-small btn-dark-gray btn-rounded w-100 mb-2">Refine Results</button>
                            <a href="{{ route('public.jobs.index') }}" class="btn btn-very-small btn-transparent-dark-gray btn-rounded w-100">Clear All</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Job List -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="fs-15 text-medium-gray mb-0">We found <span class="fw-700 text-dark-gray">{{ $jobs->total() }}</span> opportunities for you</p>
                    <div class="dropdown">
                        <button class="btn btn-transparent-dark-gray btn-very-small btn-rounded dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Sort By: Latest
                        </button>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item fs-13" href="#">Newest First</a></li>
                            <li><a class="dropdown-item fs-13" href="#">Oldest First</a></li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    @forelse($jobs as $job)
                        <div class="col-md-6 col-xl-4 mb-30px">
                            <div class="job-card-premium">
                                <div class="d-flex justify-content-between align-items-start">
                                    <span class="job-badge {{ $job->job_type == 'Full-time' ? 'bg-light-green' : ($job->job_type == 'Contract' ? 'bg-light-blue' : 'bg-light-orange') }}">
                                        {{ $job->job_type }}
                                    </span>
                                    <span class="fs-11 fw-700 text-medium-gray uppercase border px-2 py-1 border-radius-4px">#{{ $job->job_code }}</span>
                                </div>
                                <h3 class="job-title"><a href="{{ route('public.jobs.show', $job) }}">{{ $job->title }}</a></h3>
                                <p class="fs-14 text-medium-gray mb-3">{{ $job->department }}</p>
                                
                                <div class="job-meta">
                                    <span><i class="bi bi-geo-alt"></i> {{ $job->location }}</span>
                                    @if($job->website)
                                        <span><i class="bi bi-globe"></i> <a href="{{ $job->website }}" target="_blank" class="text-medium-gray text-decoration-line-bottom-hover">Website</a></span>
                                    @endif
                                    @if($job->salary_range)
                                        <span><i class="bi bi-currency-rupee"></i> {{ $job->salary_range }}</span>
                                    @endif
                                </div>

                                @if($job->deadline_date)
                                    <div class="fs-12 text-danger fw-600 mb-3">
                                        <i class="bi bi-alarm me-1"></i> Apply by {{ $job->deadline_date->format('d M, Y') }}
                                    </div>
                                @endif

                                <div class="job-skills">
                                    @if($job->skills_required && is_array($job->skills_required))
                                        @foreach(array_slice($job->skills_required, 0, 3) as $skill)
                                            <span class="skill-tag">{{ $skill }}</span>
                                        @endforeach
                                        @if(count($job->skills_required) > 3)
                                            <span class="skill-tag">+{{ count($job->skills_required) - 3 }} more</span>
                                        @endif
                                    @endif
                                </div>
                                
                                <div class="mt-4 pt-3 border-top">
                                    <a href="{{ route('public.jobs.show', $job) }}" class="btn btn-very-small btn-base-color btn-rounded w-100 fw-700">View & Apply</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <div class="stat-card py-5">
                                <i class="bi bi-search" style="font-size: 60px; color: #eee;"></i>
                                <h4 class="alt-font fw-700 text-dark-gray mt-4">No match found</h4>
                                <p class="w-60 mx-auto text-medium-gray">We couldn't find any jobs matching your current filters. Try relaxing your filters or search terms.</p>
                                <a href="{{ route('public.jobs.index') }}" class="btn btn-medium btn-dark-gray btn-rounded mt-3">Reset Filters</a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-center mt-5">
                    {{ $jobs->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
