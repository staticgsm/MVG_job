@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-700">Admin Dashboard</h1>
        @can('payment.view')
        <a href="{{ route('payments.export') }}" class="btn btn-outline-secondary btn-sm shadow-sm">
            <i class="fas fa-download fa-sm me-1 text-muted"></i> Export Finance Report
        </a>
        @endcan
    </div>

    <div class="row">
        <!-- Dashboard Stats Cards -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card stat-card shadow-sm border-0 h-100 py-2 border-start-primary">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 fs-12 letter-spacing-1">Active Candidates</div>
                            <div class="h3 mb-0 font-weight-bold text-dark">{{ number_format($stats['candidates_count']) }}</div>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon bg-primary-light text-primary rounded-circle">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card stat-card shadow-sm border-0 h-100 py-2 border-start-success">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1 fs-12 letter-spacing-1">Total Open Jobs</div>
                            <div class="h3 mb-0 font-weight-bold text-dark">{{ number_format($stats['active_jobs']) }}</div>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon bg-success-light text-success rounded-circle">
                                <i class="fas fa-briefcase"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card stat-card shadow-sm border-0 h-100 py-2 border-start-info">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1 fs-12 letter-spacing-1">Job Applications</div>
                            <div class="h3 mb-0 font-weight-bold text-dark">{{ number_format($stats['total_applications']) }}</div>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon bg-info-light text-info rounded-circle">
                                <i class="fas fa-file-invoice"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-base-color"><i class="bi bi-link-45deg me-2"></i>Quick Management Links</h6>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('admin.jobs.index') }}" class="btn btn-white w-100 text-start py-3 shadow-none border rounded-3 d-flex align-items-center">
                                <div class="icon-box bg-primary-light text-primary me-3"><i class="fas fa-briefcase"></i></div>
                                <div><div class="fw-700 text-dark">Job Listings</div><div class="text-muted small">Manage recruitment</div></div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.candidates.index') }}" class="btn btn-white w-100 text-start py-3 shadow-none border rounded-3 d-flex align-items-center">
                                <div class="icon-box bg-success-light text-success me-3"><i class="fas fa-users"></i></div>
                                <div><div class="fw-700 text-dark">Candidates</div><div class="text-muted small">User database</div></div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.subscription-plans.index') }}" class="btn btn-white w-100 text-start py-3 shadow-none border rounded-3 d-flex align-items-center">
                                <div class="icon-box bg-info-light text-info me-3"><i class="fas fa-credit-card"></i></div>
                                <div><div class="fw-700 text-dark">Subscriptions</div><div class="text-muted small">Billing & Plans</div></div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.master_data.index') }}" class="btn btn-white w-100 text-start py-3 shadow-none border rounded-3 d-flex align-items-center">
                                <div class="icon-box bg-secondary-light text-secondary me-3"><i class="fas fa-database"></i></div>
                                <div><div class="fw-700 text-dark">Master Data</div><div class="text-muted small">Global Settings</div></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .letter-spacing-1 { letter-spacing: 1px; }
    .border-start-primary { border-left: 4px solid #4e73df !important; }
    .border-start-success { border-left: 4px solid #1cc88a !important; }
    .border-start-info { border-left: 4px solid #36b9cc !important; }
    .stat-icon { width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
    .bg-primary-light { background: rgba(78, 115, 223, 0.1); }
    .bg-success-light { background: rgba(28, 200, 138, 0.1); }
    .bg-info-light { background: rgba(54, 185, 204, 0.1); }
    .bg-secondary-light { background: rgba(133, 135, 150, 0.1); }
    .icon-box { width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px; font-size: 16px; }
    .btn-white { background: #fff; border: 1px solid #eee; transition: all 0.2s; }
    .btn-white:hover { border-color: var(--brand-primary); background: #fdfdfd; transform: translateY(-3px); }
</style>
@endsection


