@extends('layouts.frontend')

@section('title', 'Candidate Dashboard - MVGC Services Private Limited')

@section('extra_css')
<style>
    .dashboard-banner {
        background: linear-gradient(rgba(239, 127, 26, 0.9), rgba(239, 127, 26, 0.9)), url('{{ asset('images/homepage4.png') }}');
        background-size: cover;
        background-position: center;
        border-radius: 15px;
        padding: 40px;
        color: #fff;
        margin-bottom: 30px;
    }
    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        height: 100%;
        transition: transform 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .stat-icon {
        width: 50px;
        height: 50px;
        background: #f0f4fd;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        color: #ef7f1a;
        font-size: 20px;
    }
    .job-item {
        border-bottom: 1px solid #f0f4fd;
        padding: 15px 0;
    }
    .job-item:last-child {
        border-bottom: none;
    }
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    .status-applied { background: #e3f2fd; color: #1976d2; }
    .status-shortlisted { background: #e8f5e9; color: #2e7d32; }
    .status-rejected { background: #ffebee; color: #c62828; }
    
    .progress-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #f0f4fd;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        font-weight: 700;
        color: #ef7f1a;
    }
    
    .sidebar-item {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        border-radius: 8px;
        color: #717580;
        margin-bottom: 5px;
        transition: all 0.3s;
    }
    .sidebar-item:hover, .sidebar-item.active {
        background: #ef7f1a;
        color: #fff;
    }
    .sidebar-item i { margin-right: 12px; }
</style>
@endsection

@section('content')
<section class="bg-solitude-blue pt-150px pb-100px">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="stat-card mb-4">
                    <div class="text-center mb-4">
                        <div class="mx-auto mb-3" style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; border: 3px solid #ef7f1a;">
                            <img src="{{ $user->candidateProfile && $user->candidateProfile->photo_path ? asset('storage/' . $user->candidateProfile->photo_path) : asset('images/MVG_logo .png') }}" alt="Profile" style="width: 100%; hieght: 100%; object-fit: cover;">
                        </div>
                        <h6 class="alt-font text-dark-gray mb-0">{{ $user->name }}</h6>
                        <p class="fs-13 text-medium-gray">{{ $user->email }}</p>
                    </div>
                    
                    <nav>
                        <a href="{{ route('candidate.dashboard') }}" class="sidebar-item active">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <a href="{{ route('candidate.profile.index') }}" class="sidebar-item">
                            <i class="bi bi-person"></i> My Profile
                        </a>
                        <a href="{{ route('candidate.applications.index') }}" class="sidebar-item">
                            <i class="bi bi-briefcase"></i> My Applications
                        </a>
                        <a href="{{ route('candidate.subscriptions.index') }}" class="sidebar-item">
                            <i class="bi bi-credit-card"></i> Subscriptions
                        </a>
                        <div class="dropdown-divider my-3"></div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="sidebar-item text-danger">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <!-- Welcome Banner -->
                <div class="dashboard-banner">
                    <h3 class="alt-font fw-600 mb-2">Hello, {{ $user->name }}!</h3>
                    <p class="mb-0 opacity-8">Welcome to your personal career portal. Keep your profile updated for better opportunities.</p>
                </div>

                <!-- Stats -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="stat-card text-center">
                            <div class="progress-circle mx-auto mb-3">
                                {{ $stats['profile_completion'] }}%
                            </div>
                            <h6 class="alt-font text-dark-gray mb-1">Profile Complete</h6>
                            <a href="{{ route('candidate.profile.index') }}" class="fs-12 text-base-color fw-600">Complete Now →</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="bi bi-briefcase"></i></div>
                            <h4 class="alt-font text-dark-gray mb-1">{{ $stats['applied_jobs_count'] }}</h4>
                            <p class="fs-14 text-medium-gray mb-0">Applied Jobs</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="bi bi-lightning-charge"></i></div>
                            <h4 class="alt-font text-dark-gray mb-1">
                                {{ $user->subscription ? $user->subscription->subscriptionPlan->name : 'No Active Plan' }}
                            </h4>
                            <p class="fs-14 text-medium-gray mb-0">Current Subscription</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Recent Applications -->
                    <div class="col-lg-8">
                        <div class="stat-card h-100">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h6 class="alt-font text-dark-gray mb-0">Recent Applications</h6>
                                <a href="{{ route('candidate.applications.index') }}" class="fs-13 text-base-color fw-600">View All</a>
                            </div>
                            
                            @if($stats['recent_applications']->count() > 0)
                                @foreach($stats['recent_applications'] as $application)
                                    <div class="job-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="fs-15 text-dark-gray mb-1">{{ $application->jobPost->title }}</h6>
                                                <p class="fs-13 text-medium-gray mb-0">{{ $application->jobPost->company_name ?? 'MVGC Services' }} • Applied on {{ $application->created_at->format('d M, Y') }}</p>
                                            </div>
                                            <span class="status-badge status-{{ strtolower($application->status) }}">
                                                {{ $application->status }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-inbox fs-40 text-extra-medium-gray mb-3"></i>
                                    <p class="text-medium-gray">You haven't applied to any jobs yet.</p>
                                    <a href="{{ route('public.jobs.index') }}" class="btn btn-small btn-base-color btn-rounded">Find Jobs</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Recommended Jobs -->
                    <div class="col-lg-4">
                        <div class="stat-card">
                            <h6 class="alt-font text-dark-gray mb-4">New Openings</h6>
                            @foreach($recommendedJobs as $job)
                                <div class="job-item">
                                    <h6 class="fs-14 text-dark-gray mb-1">{{ $job->title }}</h6>
                                    <p class="fs-12 text-medium-gray mb-2"><i class="bi bi-geo-alt"></i> {{ $job->location }}</p>
                                    <a href="{{ route('public.jobs.show', $job->id) }}" class="btn btn-very-small btn-transparent-light-gray btn-rounded w-100">View Details</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
