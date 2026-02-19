@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Account Status</h5>
                </div>
                <div class="card-body">
                    @php
                        $subscription = Auth::user()->subscription;
                    @endphp
                    @if($subscription && $subscription->end_date->isFuture())
                        <div class="alert alert-success mb-2">
                             <i class="bi bi-check-circle-fill"></i> Active
                        </div>
                        <p class="mb-1"><strong>Plan:</strong> {{ $subscription->subscriptionPlan->name }}</p>
                        <p class="mb-0 small text-muted">Expires: {{ $subscription->end_date->format('d M, Y') }}</p>
                    @else
                        <div class="alert alert-warning mb-2">
                             In-Active
                        </div>
                        <a href="{{ route('candidate.subscriptions.index') }}" class="btn btn-sm btn-primary w-100">Subscribe Now</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <h2>My Profile</h2>
            <div class="progress mt-2" style="height: 25px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $profile->profile_completion_percentage ?? 0 }}%;" aria-valuenow="{{ $profile->profile_completion_percentage ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
                    {{ $profile->profile_completion_percentage ?? 0 }}% Completed
                </div>
            </div>
            @if(($profile->profile_completion_percentage ?? 0) < 100)
                <div class="alert alert-warning mt-2">
                    Complete your profile (Personal, Education, Skills, Resume) to apply for jobs.
                </div>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" aria-controls="personal" aria-selected="true">Personal Details</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="education-tab" data-bs-toggle="tab" data-bs-target="#education" type="button" role="tab" aria-controls="education" aria-selected="false">Education</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="experience-tab" data-bs-toggle="tab" data-bs-target="#experience" type="button" role="tab" aria-controls="experience" aria-selected="false">Experience</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="skills-tab" data-bs-toggle="tab" data-bs-target="#skills" type="button" role="tab" aria-controls="skills" aria-selected="false">Skills</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" type="button" role="tab" aria-controls="documents" aria-selected="false">Documents</button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="profileTabsContent">
                <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                    @include('candidate.profile.partials.personal')
                </div>
                <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">
                    @include('candidate.profile.partials.education')
                </div>
                <div class="tab-pane fade" id="experience" role="tabpanel" aria-labelledby="experience-tab">
                    @include('candidate.profile.partials.experience')
                </div>
                <div class="tab-pane fade" id="skills" role="tabpanel" aria-labelledby="skills-tab">
                    @include('candidate.profile.partials.skills')
                </div>
                <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                    @include('candidate.profile.partials.documents')
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>
@endsection
