@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-700">HR Command Center</h1>
            <p class="text-muted small mb-0">Monitor applications, manage shortlists, and coordinate interviews.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.jobs.index') }}" class="btn btn-base-color btn-sm px-3">
                <i class="fas fa-briefcase me-2"></i>Manage Jobs
            </a>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row">
        <!-- Pending Applications -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 border-0 shadow-sm overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-muted small text-uppercase fw-600 mb-1">New Submissions</div>
                            <div class="h3 mb-0 fw-700 text-dark">{{ number_format($stats['pending_applications']) }}</div>
                        </div>
                        <div class="stat-icon-wrapper bg-soft-warning">
                            <i class="fas fa-file-import text-warning"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-muted">
                        <span class="text-warning fw-600 me-1"><i class="fas fa-clock me-1"></i>Awaiting</span> Initial Review
                    </div>
                </div>
                <div class="stat-card-progress bg-warning"></div>
            </div>
        </div>

        <!-- Shortlisted -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 border-0 shadow-sm overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-muted small text-uppercase fw-600 mb-1">Shortlisted</div>
                            <div class="h3 mb-0 fw-700 text-dark">{{ number_format($stats['shortlisted_applications']) }}</div>
                        </div>
                        <div class="stat-icon-wrapper bg-soft-primary">
                            <i class="fas fa-user-check text-primary"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-muted">
                        <span class="text-primary fw-600 me-1"><i class="fas fa-star me-1"></i>Top Talent</span> Qualified candidates
                    </div>
                </div>
                <div class="stat-card-progress bg-primary"></div>
            </div>
        </div>

        <!-- Interviews -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 border-0 shadow-sm overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-muted small text-uppercase fw-600 mb-1">Scheduled Interviews</div>
                            <div class="h3 mb-0 fw-700 text-dark">{{ number_format($stats['interview_scheduled_applications']) }}</div>
                        </div>
                        <div class="stat-icon-wrapper bg-soft-info">
                            <i class="fas fa-calendar-alt text-info"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-muted">
                        <span class="text-info fw-600 me-1"><i class="fas fa-users me-1"></i>Live Sessions</span> Active coordination
                    </div>
                </div>
                <div class="stat-card-progress bg-info"></div>
            </div>
        </div>

        <!-- Rejected -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 border-0 shadow-sm overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-muted small text-uppercase fw-600 mb-1">Not Proceeded</div>
                            <div class="h3 mb-0 fw-700 text-dark">{{ number_format($stats['rejected_applications']) }}</div>
                        </div>
                        <div class="stat-icon-wrapper bg-soft-secondary">
                            <i class="fas fa-user-slash text-secondary"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-muted">
                        <span class="text-muted fw-600 me-1"><i class="fas fa-archive me-1"></i>Archived</span> Feedback sent
                    </div>
                </div>
                <div class="stat-card-progress bg-secondary"></div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Tasks -->
    <div class="row mt-2">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3 border-bottom">
                    <h6 class="m-0 font-weight-bold text-base-color"><i class="fas fa-tasks me-2"></i>Recruitment Pipeline Overview</h6>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex flex-column gap-3">
                        <div class="p-3 bg-light-soft rounded-3 border d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-soft-primary text-primary me-3">
                                    <i class="fas fa-search"></i>
                                </div>
                                <div>
                                    <div class="fw-700 text-dark">Source Candidates</div>
                                    <div class="text-muted small">Find potential matches for ongoing projects</div>
                                </div>
                            </div>
                            <a href="{{ route('admin.candidates.index') }}" class="btn btn-white btn-sm px-3 border shadow-sm">Explore</a>
                        </div>
                        
                        <div class="p-3 bg-light-soft rounded-3 border d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-soft-info text-info me-3">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                                <div>
                                    <div class="fw-700 text-dark">Review Applications</div>
                                    <div class="text-muted small">Screen and process submitted resumes</div>
                                </div>
                            </div>
                            <a href="{{ route('admin.jobs.index') }}" class="btn btn-white btn-sm px-3 border shadow-sm">View Jobs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3 border-bottom">
                    <h6 class="m-0 font-weight-bold text-base-color"><i class="fas fa-bullseye me-2"></i>HR Insights</h6>
                </div>
                <div class="card-body p-4">
                    <div class="text-center py-3">
                        <div class="avatar-lg bg-soft-primary text-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-chart-pie fa-2x"></i>
                        </div>
                        <h6 class="fw-700 text-dark mb-2">Platform Activity</h6>
                        <p class="text-muted small">You have <strong>{{ $stats['pending_applications'] }}</strong> new applications that need your attention today.</p>
                        <hr class="my-4 light">
                        <div class="d-grid">
                            <button class="btn btn-soft-primary btn-sm rounded-pill"><i class="fas fa-print me-2"></i>Generate HR Report</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-700 { font-weight: 700; }
    .fw-600 { font-weight: 600; }
    .text-base-color { color: #ef7f1a !important; }
    .bg-light-soft { background-color: #f8f9fb; }
    
    .stat-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.1) !important; }
    
    .stat-icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }
    
    .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); }
    .bg-soft-warning { background-color: rgba(255, 193, 7, 0.1); }
    .bg-soft-info { background-color: rgba(13, 202, 240, 0.1); }
    .bg-soft-secondary { background-color: rgba(108, 117, 125, 0.1); }
    
    .stat-card-progress { height: 4px; width: 100%; position: absolute; bottom: 0; left: 0; opacity: 0.6; }
    
    .icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-white { background: #fff; border: 1px solid #eee; }
    .btn-white:hover { background: #f8f9fa; }
    
    .btn-soft-primary {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        border: none;
    }
    .btn-soft-primary:hover {
        background-color: #0d6efd;
        color: #fff;
    }
    
    .avatar-lg { width: 70px; height: 70px; }
</style>
@endsection
