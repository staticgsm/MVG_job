@extends('layouts.frontend')

@section('title', $job->title . ' - MVGC Services')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/jobs.css') }}">
@endsection

@section('content')
<!-- Job Header Section -->
<section class="jobs-hero" style="padding: 80px 0 120px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 text-center text-lg-start">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb mb-0" style="background: transparent; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-white opacity-7">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('public.jobs.index') }}" class="text-white opacity-7">Careers</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Job Details</li>
                    </ol>
                </nav>
                <h1 class="alt-font fw-700 mb-10px">{{ $job->title }}</h1>
                <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-4 fs-14 text-white opacity-8">
                    <span><i class="bi bi-briefcase me-2"></i> {{ $job->department }}</span>
                    <span><i class="bi bi-geo-alt me-2"></i> {{ $job->location }}</span>
                    <span><i class="bi bi-clock me-2"></i> {{ $job->job_type }}</span>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end mt-4 mt-lg-0">
                <span class="fs-12 fw-700 text-white uppercase border border-white border-opacity-25 px-3 py-2 border-radius-4px">Job Code: {{ $job->job_code }}</span>
            </div>
        </div>
    </div>
</section>

<section class="pb-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Job Description Card -->
                <div class="job-detail-header mb-4">
                    <div class="detail-section-title">
                        <i class="bi bi-info-circle"></i> Job Description
                    </div>
                    <div class="fs-16 lh-32 text-medium-gray mb-5">
                        {!! nl2br(e($job->description)) !!}
                    </div>

                    <div class="detail-section-title">
                        <i class="bi bi-mortarboard"></i> Eligibility & Education
                    </div>
                    <ul class="list-unstyled mb-5">
                        @if(is_array($job->education_required))
                            @foreach($job->education_required as $edu)
                                <li class="d-flex align-items-center mb-10px fs-15 text-medium-gray">
                                    <i class="bi bi-check-circle-fill text-base-color me-3"></i> {{ $edu }}
                                </li>
                            @endforeach
                        @else
                            <li class="d-flex align-items-center mb-10px fs-15 text-medium-gray">
                                <i class="bi bi-check-circle-fill text-base-color me-3"></i> {{ $job->eligibility }}
                            </li>
                        @endif
                    </ul>

                    @if($job->skills_required && is_array($job->skills_required))
                        <div class="detail-section-title">
                            <i class="bi bi-lightning-charge"></i> Required Skills
                        </div>
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            @foreach($job->skills_required as $skill)
                                <span class="badge bg-solitude-blue text-dark-gray border px-3 py-2 fs-13 border-radius-4px">{{ $skill }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Action Sidebar -->
                <div class="job-filter-sidebar mt-lg-n5">
                    <div class="filter-title mb-4">
                        <i class="bi bi-lightning"></i> Quick Overview
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fs-14 text-medium-gray">Experience</span>
                            <span class="fs-14 fw-700 text-dark-gray">{{ $job->experience }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fs-14 text-medium-gray">Salary Range</span>
                            <span class="fs-14 fw-700 text-success">{{ $job->salary_range ?? 'Not Disclosed' }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fs-14 text-medium-gray">Positions</span>
                            <span class="fs-14 fw-700 text-dark-gray">{{ $job->vacancies ?? '1' }}</span>
                        </div>
                        @if($job->website)
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fs-14 text-medium-gray">Website</span>
                                <span class="fs-14 fw-700 text-dark-gray text-decoration-line-bottom-hover"><a href="{{ $job->website }}" target="_blank">Visit Site</a></span>
                            </div>
                        @endif
                        @if($job->deadline_date)
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fs-14 text-medium-gray">Deadline</span>
                                <span class="fs-14 fw-700 text-danger">{{ $job->deadline_date->format('d M, Y') }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="pt-3 border-top">
                        @auth
                            @if(auth()->user()->hasRole('candidate'))
                                @php
                                    $hasApplied = $job->applications()->where('user_id', auth()->id())->exists();
                                @endphp

                                @if($hasApplied)
                                    <div class="alert alert-success d-flex align-items-center border-radius-10px">
                                        <i class="bi bi-check-circle-fill me-2 fs-20"></i>
                                        <span class="fs-14 fw-600">Application Submitted!</span>
                                    </div>
                                @elseif((auth()->user()->candidateProfile->profile_completion_percentage ?? 0) >= 100)
                                    @if($job->status == 'Open' && ($job->deadline_date == null || $job->deadline_date->isFuture() || $job->deadline_date->isToday()))
                                        <form action="{{ route('jobs.apply', $job) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-medium btn-base-color btn-rounded w-100 fw-700 btn-box-shadow mb-3">Apply for this Position</button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-medium btn-dark-gray btn-rounded w-100 fw-700" disabled>Applications Closed</button>
                                    @endif
                                @else
                                    <div class="alert alert-warning border-radius-10px mb-3">
                                        <span class="fs-13 fw-600 d-block mb-1">Incomplete Profile ({{ auth()->user()->candidateProfile->profile_completion_percentage ?? 0 }}%)</span>
                                        <p class="fs-12 mb-0">Please complete your profile to 100% to apply for this job.</p>
                                    </div>
                                    <a href="{{ route('candidate.profile.index') }}" class="btn btn-medium btn-base-color btn-rounded w-100 fw-700 mb-3">Complete Profile</a>
                                @endif
                            @else
                                <div class="alert alert-info border-radius-10px mb-3">
                                    <span class="fs-13 fw-600">Switch to Candidate account to apply.</span>
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-medium btn-base-color btn-rounded w-100 fw-700 btn-box-shadow mb-3">Login to Apply</a>
                            <p class="text-center fs-12 text-medium-gray">Don't have an account? <a href="{{ route('register') }}" class="text-base-color fw-700">Register Now</a></p>
                        @endauth
                        
                        <a href="{{ route('public.jobs.index') }}" class="btn btn-very-small btn-transparent-dark-gray btn-rounded w-100">Browse more jobs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
