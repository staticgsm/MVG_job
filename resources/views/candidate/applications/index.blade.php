@extends('layouts.frontend')

@section('title', 'My Applications — MVGC Services')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/candidate-dashboard.css') }}">
<style>
    /* Applications table */
    .app-table { width: 100%; border-collapse: collapse; }
    .app-table thead tr th {
        font-size: 11px; font-weight: 700; text-transform: uppercase;
        letter-spacing: .5px; color: #718096;
        padding: 0 16px 14px; border-bottom: 2px solid #eef2f7;
    }
    .app-table tbody tr {
        border-bottom: 1px solid #eef2f7;
        transition: background .2s;
    }
    .app-table tbody tr:last-child { border-bottom: none; }
    .app-table tbody tr:hover { background: #fafbfd; }
    .app-table tbody td { padding: 16px; vertical-align: middle; }

    /* Status badges */
    .app-badge {
        display: inline-block; padding: 5px 14px;
        border-radius: 20px; font-size: 11px; font-weight: 700;
    }
    .badge-applied      { background: #eff6ff; color: #2563eb; }
    .badge-shortlisted  { background: #f0fdf4; color: #16a34a; }
    .badge-rejected     { background: #fef2f2; color: #dc2626; }
    .badge-interview    { background: #fff7ed; color: #c2410c; }

    /* Cancel btn */
    .btn-cancel {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 6px 14px; border-radius: 20px;
        font-size: 12px; font-weight: 600;
        border: 1.5px solid #fca5a5; color: #dc2626;
        background: transparent; cursor: pointer; transition: all .2s;
    }
    .btn-cancel:hover { background: #fef2f2; }

    /* Job icon */
    .job-icon {
        width: 40px; height: 40px; border-radius: 10px;
        background: #fff4e8; color: #ef7f1a;
        display: flex; align-items: center; justify-content: center;
        font-size: 17px; flex-shrink: 0;
    }

    /* Summary pills */
    .app-summary-pills { display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 24px; }
    .summary-pill {
        background: #fff; border-radius: 12px; padding: 12px 20px;
        box-shadow: 0 2px 12px rgba(0,0,0,.05); border: 1px solid #eef2f7;
        font-size: 13px; font-weight: 600; color: #1a202c;
        display: flex; align-items: center; gap: 8px;
    }
    .summary-pill .pill-num { font-size: 20px; font-weight: 800; }
    .summary-pill .pill-dot { width: 10px; height: 10px; border-radius: 50%; }
</style>
@endsection

@section('content')

@php $user = auth()->user(); @endphp

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
                    <span class="cd-status-pill {{ $user->status ? 'cd-status-active' : 'cd-status-inactive' }}">
                        {{ $user->status ? '● Active' : '● Inactive' }}
                    </span>

                    <nav class="cd-nav text-start">
                        <a href="{{ route('candidate.dashboard') }}">
                            <i class="bi bi-grid-fill"></i> Dashboard
                        </a>
                        <a href="{{ route('candidate.profile.index') }}">
                            <i class="bi bi-person-circle"></i> My Profile
                        </a>
                        <a href="{{ route('candidate.applications.index') }}" class="active">
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

                {{-- Alerts --}}
                @if(session('success'))
                    <div class="alert alert-success rounded-3 border-0 shadow-sm mb-3">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger rounded-3 border-0 shadow-sm mb-3">
                        <i class="bi bi-exclamation-circle-fill me-2"></i> {{ session('error') }}
                    </div>
                @endif

                {{-- Summary Pills --}}
                @php
                    $totalApps     = $applications->count();
                    $shortlisted   = $applications->where('status', 'Shortlisted')->count();
                    $rejected      = $applications->where('status', 'Rejected')->count();
                    $pending       = $applications->where('status', 'Applied')->count();
                @endphp
                <div class="app-summary-pills">
                    <div class="summary-pill">
                        <span class="pill-dot" style="background:#818cf8;"></span>
                        <div><div class="pill-num">{{ $totalApps }}</div><div style="font-size:11px;color:#718096;font-weight:500;">Total</div></div>
                    </div>
                    <div class="summary-pill">
                        <span class="pill-dot" style="background:#34d399;"></span>
                        <div><div class="pill-num">{{ $shortlisted }}</div><div style="font-size:11px;color:#718096;font-weight:500;">Shortlisted</div></div>
                    </div>
                    <div class="summary-pill">
                        <span class="pill-dot" style="background:#fbbf24;"></span>
                        <div><div class="pill-num">{{ $pending }}</div><div style="font-size:11px;color:#718096;font-weight:500;">Pending</div></div>
                    </div>
                    <div class="summary-pill">
                        <span class="pill-dot" style="background:#f87171;"></span>
                        <div><div class="pill-num">{{ $rejected }}</div><div style="font-size:11px;color:#718096;font-weight:500;">Rejected</div></div>
                    </div>
                </div>

                {{-- Applications Card --}}
                <div class="cd-card">
                    <div class="cd-card-header">
                        <span class="cd-card-title">
                            <i class="bi bi-journal-bookmark-fill"></i> My Job Applications
                        </span>
                        <span style="font-size:12px;color:#718096;font-weight:500;">{{ $totalApps }} record(s)</span>
                    </div>

                    @if($applications->count() > 0)
                        <div class="table-responsive">
                            <table class="app-table">
                                <thead>
                                    <tr>
                                        <th>Job Opportunity</th>
                                        <th>Applied Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applications as $application)
                                        <tr>
                                            {{-- Job Info --}}
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="job-icon"><i class="bi bi-briefcase-fill"></i></div>
                                                    <div>
                                                        <a href="{{ route('public.jobs.show', $application->jobPost) }}"
                                                           style="font-size:13.5px;font-weight:700;color:#1a202c;text-decoration:none;"
                                                           onmouseover="this.style.color='#ef7f1a'" onmouseout="this.style.color='#1a202c'">
                                                            {{ $application->jobPost->title }}
                                                        </a>
                                                        <div style="font-size:12px;color:#718096;margin-top:2px;">
                                                            {{ $application->jobPost->company_name ?? 'MVGC Services' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Date --}}
                                            <td>
                                                <span style="font-size:13px;color:#4a5568;font-weight:500;">
                                                    {{ \Carbon\Carbon::parse($application->applied_at)->format('d M, Y') }}
                                                </span>
                                            </td>

                                            {{-- Status Badge --}}
                                            <td>
                                                @php $s = strtolower($application->status); @endphp
                                                <span class="app-badge badge-{{ $s === 'applied' ? 'applied' : ($s === 'shortlisted' ? 'shortlisted' : ($s === 'rejected' ? 'rejected' : 'interview')) }}">
                                                    {{ $application->status }}
                                                </span>
                                            </td>

                                            {{-- Action --}}
                                            <td>
                                                @if($application->status == 'Applied')
                                                    <form action="{{ route('candidate.applications.destroy', $application) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Cancel this application?');">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn-cancel">
                                                            <i class="bi bi-x-circle"></i> Cancel
                                                        </button>
                                                    </form>
                                                @else
                                                    <span style="font-size:12px;color:#cbd5e0;">—</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="cd-empty" style="padding: 50px 0;">
                            <i class="bi bi-inbox" style="font-size:52px;opacity:.2;display:block;margin-bottom:16px;"></i>
                            <p style="font-size:15px;font-weight:600;color:#1a202c;margin-bottom:6px;">No applications yet</p>
                            <p style="font-size:13px;color:#718096;margin-bottom:20px;">You haven't applied to any positions. Start exploring open roles!</p>
                            <a href="{{ route('public.jobs.index') }}" class="cd-btn-orange" style="display:inline-block;max-width:200px;">
                                Browse Openings
                            </a>
                        </div>
                    @endif
                </div>

            </div>{{-- /col main --}}
        </div>{{-- /row --}}
    </div>{{-- /container --}}
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

@endsection
