@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2 class="h4 mb-0">{{ $job->title }}</h2>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h5 class="text-muted mb-3">
                                Job Code: <span class="badge bg-secondary">{{ $job->job_code }}</span>
                                @if($job->project_name)
                                    <span class="badge bg-info text-dark ms-2">{{ $job->project_name }}</span>
                                @endif
                                <span class="badge bg-{{ $job->status == 'Open' ? 'success' : 'danger' }} ms-2">{{ $job->status }}</span>
                            </h5>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>Department:</strong> {{ $job->department }}</p>
                            <p><strong>Location:</strong> {{ $job->location }}</p>
                            <p><strong>Job Type:</strong> {{ $job->job_type }}</p>
                            <p><strong>Experience:</strong> {{ $job->experience }}</p>
                            @if($job->salary_range)
                                <p><strong>Salary:</strong> {{ $job->salary_range }}</p>
                            @endif
                            @if($job->deadline_date)
                                <p><strong>Apply By:</strong> <span class="text-danger fw-bold">{{ $job->deadline_date->format('d M Y') }}</span></p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <p><strong>Education Required:</strong></p>
                            <ul>
                                @if(is_array($job->education_required))
                                    @foreach($job->education_required as $edu)
                                        <li>{{ $edu }}</li>
                                    @endforeach
                                @else
                                    <li>{{ $job->eligibility }}</li>
                                @endif
                            </ul>

                            @if($job->skills_required && is_array($job->skills_required))
                                <p><strong>Skills Required:</strong></p>
                                <div>
                                    @foreach($job->skills_required as $skill)
                                        <span class="badge bg-primary me-1">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3">Job Description</h5>
                    <div class="mb-4">
                        {!! nl2br(e($job->description)) !!}
                    </div>

                    <div class="d-grid gap-2">
                        @auth
                            @if(auth()->user()->hasRole('candidate'))
                                @php
                                    $hasApplied = $job->applications()->where('user_id', auth()->id())->exists();
                                @endphp

                                @if($hasApplied)
                                    <button type="button" class="btn btn-info btn-lg" disabled>Already Applied</button>
                                @elseif((auth()->user()->candidateProfile->profile_completion_percentage ?? 0) >= 100)
                                    @if($job->status == 'Open' && ($job->deadline_date == null || $job->deadline_date->isFuture() || $job->deadline_date->isToday()))
                                        <form action="{{ route('jobs.apply', $job) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-lg w-100">Apply Now</button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-danger btn-lg" disabled>Applications Closed</button>
                                    @endif
                                @else
                                    <button type="button" class="btn btn-secondary btn-lg" disabled>Complete Profile to Apply ({{ auth()->user()->candidateProfile->profile_completion_percentage ?? 0 }}%)</button>
                                    <a href="{{ route('candidate.profile.index') }}" class="btn btn-link text-center">Go to Profile</a>
                                @endif
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-success btn-lg">Login to Apply</a>
                        @endauth
                        <a href="{{ route('public.jobs.index') }}" class="btn btn-secondary">Back to Jobs</a>
                    </div>
                </div>
                <div class="card-footer text-muted text-center">
                    Posted {{ $job->created_at->format('d M Y') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
