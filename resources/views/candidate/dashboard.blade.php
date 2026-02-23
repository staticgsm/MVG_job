@extends('layouts.frontend')

@section('title', 'My Dashboard — MVGC Services')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/candidate-dashboard.css') }}">
@endsection

@section('content')

<div class="cd-page">
    <div class="container">
        <div class="row g-4">

            {{-- ═══════════════════════════════ SIDEBAR ═══════════════════════════════ --}}
            <div class="col-lg-3">

                {{-- Profile Card --}}
                <div class="cd-sidebar text-center">
                    <div class="cd-avatar-wrap">
                        <img src="{{ $user->candidateProfile && $user->candidateProfile->photo_path
                                    ? Storage::url($user->candidateProfile->photo_path)
                                    : asset('images/MVG_logo .png') }}"
                             alt="Profile Photo">
                    </div>
                    <p class="cd-sidebar-name">{{ $user->name }}</p>
                    <p class="cd-sidebar-email">{{ $user->email }}</p>
                    <span class="cd-status-pill {{ $user->status ? 'cd-status-active' : 'cd-status-inactive' }}">
                        {{ $user->status ? '● Active' : '● Inactive' }}
                    </span>

                    <nav class="cd-nav text-start">
                        <a href="{{ route('candidate.dashboard') }}" class="active">
                            <i class="bi bi-grid-fill"></i> Dashboard
                        </a>
                        <a href="{{ route('candidate.profile.index') }}">
                            <i class="bi bi-person-circle"></i> My Profile
                        </a>
                        <a href="{{ route('candidate.applications.index') }}">
                            <i class="bi bi-journal-bookmark-fill"></i> Applications
                        </a>
                        <a href="{{ route('candidate.subscriptions.index') }}">
                            <i class="bi bi-patch-check-fill"></i> Subscription
                        </a>
                        <div class="nav-divider"></div>
                        <a href="{{ route('logout') }}" class="logout"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </nav>
                </div>



            </div>{{-- /col sidebar --}}

            {{-- ═══════════════════════════════ MAIN CONTENT ═══════════════════════════════ --}}
            <div class="col-lg-9">

                {{-- Welcome Banner --}}
                <div class="cd-banner">
                    <div class="row align-items-center">
                        <div class="col-md-9">
                            <p class="cd-banner-welcome">Welcome Back</p>
                            <h2 class="cd-banner-title">Hello, {{ explode(' ', $user->name)[0] }}! 👋</h2>
                            <p class="cd-banner-sub">
                                You have <strong>{{ $stats['pending_count'] }}</strong> pending application(s)
                                and <strong>{{ $stats['shortlisted_count'] }}</strong> shortlist(s). Keep going!
                            </p>
                        </div>
                        <div class="col-md-3 d-none d-md-flex justify-content-end">
                            <i class="bi bi-briefcase-fill" style="font-size:90px;opacity:.12;color:#fff;"></i>
                        </div>
                    </div>
                </div>

                {{-- Action Required Alert --}}
                @if(count($missingItems) > 0)
                <div class="cd-alert">
                    <div class="cd-alert-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
                    <div>
                        <p class="cd-alert-title">Complete Your Profile to Apply for Jobs</p>
                        <p class="cd-alert-sub">Fill in the missing sections below to reach 100% and unlock job applications.</p>
                        <div class="cd-alert-items">
                            @foreach($missingItems as $item)
                                <a href="{{ route('candidate.profile.index', ['active_tab' => $item['tab']]) }}"
                                   class="cd-alert-chip">
                                    <i class="bi bi-arrow-right-circle-fill"></i> {{ $item['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                {{-- Stat Cards --}}
                @php
                    $completion = $stats['profile_completion'] ?? 0;
                    if ($completion > 70) { $barColor = '#22c55e'; }
                    elseif ($completion > 30) { $barColor = '#f59e0b'; }
                    else { $barColor = '#ef4444'; }
                @endphp
                <div class="cd-stats">
                    <div class="cd-stat">
                        <div class="cd-stat-icon icon-purple"><i class="bi bi-send-fill"></i></div>
                        <div class="cd-stat-value">{{ $stats['applied_jobs_count'] }}</div>
                        <div class="cd-stat-label">Applications Sent</div>
                    </div>
                    <div class="cd-stat">
                        <div class="cd-stat-icon icon-green"><i class="bi bi-check-circle-fill"></i></div>
                        <div class="cd-stat-value">{{ $stats['shortlisted_count'] }}</div>
                        <div class="cd-stat-label">Shortlisted</div>
                    </div>
                    <div class="cd-stat">
                        <div class="cd-stat-icon icon-red"><i class="bi bi-x-circle-fill"></i></div>
                        <div class="cd-stat-value">{{ $stats['rejected_count'] }}</div>
                        <div class="cd-stat-label">Rejected</div>
                    </div>
                    <div class="cd-stat">
                        <div class="cd-stat-icon icon-orange"><i class="bi bi-lightning-charge-fill"></i></div>
                        <div class="cd-stat-value">{{ $completion }}%</div>
                        <div class="cd-stat-label">Profile Complete</div>
                        <div class="cd-stat-bar">
                            <div class="cd-stat-bar-fill" style="width:{{ $completion }}%; background:{{ $barColor }};"></div>
                        </div>
                    </div>
                </div>

                {{-- Main Grid: left 8 col, right 4 col --}}
                <div class="row g-4">
                    <div class="col-lg-8">

                        {{-- Profile Snapshot --}}
                        <div class="cd-card">
                            <div class="cd-card-header">
                                <span class="cd-card-title"><i class="bi bi-person-lines-fill"></i> Profile Snapshot</span>
                                <a href="{{ route('candidate.profile.index') }}" class="cd-card-link">Edit <i class="bi bi-pencil-square"></i></a>
                            </div>
                            <div class="cd-profile-row">
                                <div class="cd-profile-item">
                                    <div class="cd-profile-label">Full Name</div>
                                    <div class="cd-profile-value">{{ $user->name }}</div>
                                </div>
                                <div class="cd-profile-item">
                                    <div class="cd-profile-label">Phone</div>
                                    <div class="cd-profile-value {{ !$user->candidateProfile?->phone ? 'empty' : '' }}">
                                        {{ $user->candidateProfile?->phone ?? 'Not added' }}
                                    </div>
                                </div>
                                <div class="cd-profile-item">
                                    <div class="cd-profile-label">Gender</div>
                                    <div class="cd-profile-value {{ !$user->candidateProfile?->gender ? 'empty' : '' }}">
                                        {{ $user->candidateProfile?->gender ?? 'Not added' }}
                                    </div>
                                </div>
                                <div class="cd-profile-item">
                                    <div class="cd-profile-label">Aadhaar No.</div>
                                    <div class="cd-profile-value {{ !$user->candidateProfile?->aadhaar_no ? 'empty' : '' }}">
                                        {{ $user->candidateProfile?->aadhaar_no ? '***** ' . substr($user->candidateProfile->aadhaar_no, -4) : 'Not added' }}
                                    </div>
                                </div>
                                <div class="cd-profile-item" style="grid-column:1/-1">
                                    <div class="cd-profile-label">Address</div>
                                    <div class="cd-profile-value {{ !$user->candidateProfile?->city ? 'empty' : '' }}">
                                        {{ trim(($user->candidateProfile?->city ?? '') . ', ' . ($user->candidateProfile?->district ?? '') . ', ' . ($user->candidateProfile?->state ?? ''), ', ') ?: 'Not added' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Education & Experience --}}
                        <div class="row g-3 mb-0">
                            <div class="col-md-6">
                                <div class="cd-card" style="margin-bottom:0">
                                    <div class="cd-card-header" style="margin-bottom:14px">
                                        <span class="cd-card-title"><i class="bi bi-mortarboard-fill"></i> Education</span>
                                        <a href="{{ route('candidate.profile.index', ['active_tab'=>'education']) }}" class="cd-card-link">Add</a>
                                    </div>
                                    @forelse($user->candidateEducations as $edu)
                                        <div style="margin-bottom:12px; padding-bottom:12px; border-bottom:1px solid #eef2f7;">
                                            <div class="cd-profile-value" style="margin-bottom:2px">{{ $edu->course_name }}</div>
                                            <div class="cd-profile-label" style="text-transform:none;letter-spacing:0">{{ $edu->institute_name }}</div>
                                            <div style="font-size:11px;color:var(--brand-orange);font-weight:600;margin-top:2px">
                                                {{ $edu->passing_year }} · {{ $edu->marks_percentage }}%
                                            </div>
                                        </div>
                                    @empty
                                        <div class="cd-empty"><i class="bi bi-mortarboard"></i>No education added yet.</div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="cd-card" style="margin-bottom:0">
                                    <div class="cd-card-header" style="margin-bottom:14px">
                                        <span class="cd-card-title"><i class="bi bi-briefcase-fill"></i> Experience</span>
                                        <a href="{{ route('candidate.profile.index', ['active_tab'=>'experience']) }}" class="cd-card-link">Add</a>
                                    </div>
                                    @forelse($user->candidateExperiences as $exp)
                                        <div style="margin-bottom:12px; padding-bottom:12px; border-bottom:1px solid #eef2f7;">
                                            <div class="cd-profile-value" style="margin-bottom:2px">{{ $exp->designation }}</div>
                                            <div class="cd-profile-label" style="text-transform:none;letter-spacing:0">{{ $exp->company_name }}</div>
                                            <div style="font-size:11px;color:var(--brand-orange);font-weight:600;margin-top:2px">
                                                {{ $exp->start_date->format('M Y') }} – {{ $exp->end_date ? $exp->end_date->format('M Y') : 'Present' }}
                                            </div>
                                        </div>
                                    @empty
                                        <div class="cd-empty"><i class="bi bi-briefcase"></i>
                                            {{ $user->candidateProfile?->has_no_experience ? 'Fresher (No experience)' : 'No experience added.' }}
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        {{-- Recent Applications --}}
                        <div class="cd-card">
                            <div class="cd-card-header">
                                <span class="cd-card-title"><i class="bi bi-clock-history"></i> Recent Applications</span>
                                <a href="{{ route('candidate.applications.index') }}" class="cd-card-link">View All <i class="bi bi-arrow-right"></i></a>
                            </div>
                            @if($stats['recent_applications']->count() > 0)
                                @foreach($stats['recent_applications'] as $application)
                                    <div class="cd-app-row">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="cd-app-icon"><i class="bi bi-briefcase-fill"></i></div>
                                            <div>
                                                <div class="cd-app-title">{{ $application->jobPost->title }}</div>
                                                <div class="cd-app-date">Applied {{ $application->created_at->format('d M, Y') }}</div>
                                            </div>
                                        </div>
                                        @php $s = strtolower($application->status); @endphp
                                        <span class="cd-badge cd-badge-{{ $s === 'applied' ? 'applied' : ($s === 'shortlisted' ? 'shortlisted' : ($s === 'rejected' ? 'rejected' : 'applied')) }}">
                                            {{ $application->status }}
                                        </span>
                                    </div>
                                @endforeach
                            @else
                                <div class="cd-empty">
                                    <i class="bi bi-inbox"></i>
                                    No applications yet.
                                    <br><a href="{{ route('public.jobs.index') }}" class="cd-btn-orange mt-3" style="display:inline-block;max-width:200px">Browse Jobs</a>
                                </div>
                            @endif
                        </div>

                    </div>{{-- /col-lg-8 --}}

                    <div class="col-lg-4">

                        {{-- My Skills --}}
                        <div class="cd-card">
                            <div class="cd-card-header">
                                <span class="cd-card-title"><i class="bi bi-stars"></i> My Skills</span>
                                <a href="{{ route('candidate.profile.index', ['active_tab'=>'skills']) }}" class="cd-card-link">Edit</a>
                            </div>
                            @if($user->candidateSkills->count() > 0)
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($user->candidateSkills as $skill)
                                        <span class="cd-skill-tag">{{ $skill->skill_name }}</span>
                                    @endforeach
                                </div>
                            @else
                                <div class="cd-empty"><i class="bi bi-stars"></i>No skills listed yet.</div>
                            @endif
                        </div>

                        {{-- New Openings --}}
                        <div class="cd-card">
                            <div class="cd-card-header">
                                <span class="cd-card-title"><i class="bi bi-lightning-charge-fill"></i> New Openings</span>
                            </div>
                            @if($recommendedJobs->count() > 0)
                                @foreach($recommendedJobs as $job)
                                    <div class="cd-job-item">
                                        <div class="cd-job-title">{{ $job->title }}</div>
                                        <div class="cd-job-meta"><i class="bi bi-geo-alt-fill"></i> {{ $job->location ?? 'Location TBD' }}</div>
                                        <a href="{{ route('public.jobs.show', $job->id) }}" class="cd-job-btn">View Details</a>
                                    </div>
                                @endforeach
                                <a href="{{ route('public.jobs.index') }}" class="cd-btn-orange">Explore All Jobs</a>
                            @else
                                <div class="cd-empty"><i class="bi bi-search"></i>No openings at the moment.</div>
                            @endif
                        </div>

                    </div>{{-- /col-lg-4 --}}
                </div>{{-- /row --}}

            </div>{{-- /col main --}}
        </div>{{-- /row --}}
    </div>{{-- /container --}}
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

@endsection
