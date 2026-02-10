@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Admin Dashboard</h1>
    @can('payment.view')
    <a href="{{ route('payments.export') }}" class="btn btn-sm btn-outline-secondary">
        <i class="fas fa-download"></i> Export Payments
    </a>
    @endcan
</div>

<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Active Candidates</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['candidates_count'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active Jobs</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['active_jobs'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Applications</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_applications'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Links</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.jobs.index') }}" class="btn btn-primary btn-block text-left mb-2">
                    <i class="fas fa-briefcase mr-2"></i> Manage Jobs
                </a>
                <a href="{{ route('admin.candidates.index') }}" class="btn btn-success btn-block text-left mb-2">
                    <i class="fas fa-users mr-2"></i> Manage Candidates
                </a>
                <a href="{{ route('admin.subscription-plans.index') }}" class="btn btn-info btn-block text-left">
                    <i class="fas fa-credit-card mr-2"></i> Manage Subscriptions
                </a>
            </div>
        </div>
    </div>
</div>
@endsection


