@extends('layouts.frontend')

@section('title', 'My Profile — MVGC Services')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/candidate-dashboard.css') }}">
<style>
    /* Tabs */
    .profile-tabs { border-bottom: 2px solid #eef2f7; margin-bottom: 28px; display: flex; flex-wrap: wrap; gap: 4px; }
    .profile-tab-btn {
        background: none; border: none; outline: none;
        padding: 12px 20px;
        font-size: 13px; font-weight: 600; color: #718096;
        border-bottom: 3px solid transparent;
        cursor: pointer; transition: all .25s; border-radius: 0;
    }
    .profile-tab-btn:hover { color: #ef7f1a; }
    .profile-tab-btn.active { color: #ef7f1a; border-bottom-color: #ef7f1a; }

    /* Completion bar */
    .prof-completion-bar { background: #eef2f7; border-radius: 4px; height: 8px; flex: 1; max-width: 260px; overflow: hidden; }
    .prof-completion-fill { height: 100%; border-radius: 4px; transition: width 1s ease; }

    /* Save button */
    .btn-profile-save {
        background: linear-gradient(135deg,#ef7f1a,#f5a623);
        border: none; color: #fff; font-weight: 700;
        font-size: 13px; letter-spacing: .5px;
        padding: 12px 32px; border-radius: 24px;
        box-shadow: 0 4px 16px rgba(239,127,26,.3);
        transition: opacity .2s;
    }
    .btn-profile-save:hover { opacity: .88; color: #fff; }

    /* Form inputs */
    .form-control, .form-select {
        border-radius: 10px; border: 1.5px solid #eef2f7;
        font-size: 13.5px; padding: 10px 14px;
        transition: border-color .2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #ef7f1a; box-shadow: 0 0 0 3px rgba(239,127,26,.12);
    }
    .form-label { font-size: 12px; font-weight: 600; color: #718096; text-transform: uppercase; letter-spacing: .4px; margin-bottom: 6px; }
</style>
@endsection

@section('content')

@php
    $user = auth()->user();
    $completion = $profile->profile_completion_percentage ?? 0;
    if ($completion > 70) { $barColor = '#22c55e'; }
    elseif ($completion > 30) { $barColor = '#f59e0b'; }
    else { $barColor = '#ef4444'; }
@endphp

<div class="cd-page">
    <div class="container">
        <div class="row g-4">

            {{-- ══════════ SIDEBAR ══════════ --}}
            <div class="col-lg-3">
                <div class="cd-sidebar text-center">
                    <div class="cd-avatar-wrap">
                        <img src="{{ $user->candidateProfile && $user->candidateProfile->photo_path
                                    ? Storage::url($user->candidateProfile->photo_path)
                                    : asset('images/MVG_logo .png') }}"
                             alt="Profile Photo">
                    </div>
                    <p class="cd-sidebar-name">{{ $user->name }}</p>
                    <p class="cd-sidebar-email">{{ $user->email }}</p>

                    {{-- Mini completion bar in sidebar --}}
                    <div style="margin: 10px 0 14px;">
                        <div style="display:flex;align-items:center;justify-content:center;gap:8px;">
                            <div class="prof-completion-bar" style="max-width:120px">
                                <div class="prof-completion-fill" style="width:{{ $completion }}%;background:{{ $barColor }};"></div>
                            </div>
                            <span style="font-size:12px;font-weight:700;color:#1a202c;">{{ $completion }}%</span>
                        </div>
                    </div>

                    <nav class="cd-nav text-start">
                        <a href="{{ route('candidate.dashboard') }}">
                            <i class="bi bi-grid-fill"></i> Dashboard
                        </a>
                        <a href="{{ route('candidate.profile.index') }}" class="active">
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
            </div>

            {{-- ══════════ MAIN CONTENT ══════════ --}}
            <div class="col-lg-9">
                <div class="cd-card p-0 overflow-hidden">

                    {{-- Completion Header --}}
                    <div style="background:#fff; padding:16px 28px; border-bottom:1px solid #eef2f7; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
                        <div style="display:flex;align-items:center;gap:16px;">
                            <span style="font-size:12px;font-weight:700;color:#1a202c;text-transform:uppercase;letter-spacing:.5px;">Profile Completion</span>
                            <div class="prof-completion-bar">
                                <div class="prof-completion-fill" style="width:{{ $completion }}%;background:{{ $barColor }};"></div>
                            </div>
                            <span style="font-size:14px;font-weight:800;color:#1a202c;">{{ $completion }}%</span>
                        </div>
                        @if($completion < 100)
                            <span style="background:#fff4e8;color:#ef7f1a;border-radius:20px;padding:6px 14px;font-size:11px;font-weight:700;">
                                <i class="bi bi-lightning-fill"></i> Complete Profile to Apply
                            </span>
                        @else
                            <span style="background:#ecfdf5;color:#059669;border-radius:20px;padding:6px 14px;font-size:11px;font-weight:700;">
                                <i class="bi bi-check-circle-fill"></i> Ready to Apply
                            </span>
                        @endif
                    </div>

                    {{-- Alerts --}}
                    <div style="padding: 20px 28px 0;">
                        @if(session('success'))
                            <div class="alert alert-success rounded-3 border-0 shadow-sm mb-0">
                                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger rounded-3 border-0 shadow-sm mb-0">
                                <i class="bi bi-exclamation-circle-fill me-2"></i> {{ session('error') }}
                            </div>
                        @endif
                    </div>

                    {{-- Tabs --}}
                    <div style="padding: 20px 28px 0;">
                        <div class="profile-tabs" id="profileTabs" role="tablist">
                            <button class="profile-tab-btn active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab">Personal Details</button>
                            <button class="profile-tab-btn" id="education-tab" data-bs-toggle="tab" data-bs-target="#education" type="button" role="tab">Education</button>
                            <button class="profile-tab-btn" id="experience-tab" data-bs-toggle="tab" data-bs-target="#experience" type="button" role="tab">Experience</button>
                            <button class="profile-tab-btn" id="skills-tab" data-bs-toggle="tab" data-bs-target="#skills" type="button" role="tab">Skills</button>
                            <button class="profile-tab-btn" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" type="button" role="tab">Documents</button>
                        </div>

                        <div class="tab-content" style="padding-bottom:28px;">
                            <div class="tab-pane fade show active" id="personal" role="tabpanel">
                                @include('candidate.profile.partials.personal')
                            </div>
                            <div class="tab-pane fade" id="education" role="tabpanel">
                                @include('candidate.profile.partials.education')
                            </div>
                            <div class="tab-pane fade" id="experience" role="tabpanel">
                                @include('candidate.profile.partials.experience')
                            </div>
                            <div class="tab-pane fade" id="skills" role="tabpanel">
                                @include('candidate.profile.partials.skills')
                            </div>
                            <div class="tab-pane fade" id="documents" role="tabpanel">
                                @include('candidate.profile.partials.documents')
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const activeTab = urlParams.get('active_tab');
    if (activeTab) {
        const tabEl = document.querySelector('#' + activeTab + '-tab');
        if (tabEl) {
            const tab = new bootstrap.Tab(tabEl);
            tab.show();
            tabEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
});
</script>

@endsection
