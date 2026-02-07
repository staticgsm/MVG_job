@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Admin Dashboard</h1>
</div>

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<div class="row">
    <!-- Candidate Management Card -->
    <div class="col-md-4 mb-4">
        <div class="card shadow h-100">
            <div class="card-body text-center">
                <i class="bi bi-people-fill display-4 text-primary mb-3"></i>
                <h5 class="card-title">Candidate Management</h5>
                <p class="card-text">View candidates, subscriptions, and profiles.</p>
                <a href="{{ route('admin.candidates.index') }}" class="btn btn-outline-primary">Manage Candidates</a>
            </div>
        </div>
    </div>

    <!-- Subscription Plans Card -->
    <div class="col-md-4 mb-4">
        <div class="card shadow h-100">
            <div class="card-body text-center">
                <i class="bi bi-credit-card-2-front-fill display-4 text-success mb-3"></i>
                <h5 class="card-title">Subscription Plans</h5>
                <p class="card-text">Create, edit, and manage subscription pricing.</p>
                <a href="{{ route('admin.subscription-plans.index') }}" class="btn btn-outline-success">Manage Plans</a>
            </div>
        </div>
    </div>

    <!-- Job Management Card (Existing) -->
    <div class="col-md-4 mb-4">
        <div class="card shadow h-100">
            <div class="card-body text-center">
                <i class="bi bi-briefcase-fill display-4 text-info mb-3"></i>
                <h5 class="card-title">Job Management</h5>
                <p class="card-text">Post new jobs, view applications, and more.</p>
                <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-info">Manage Jobs</a>
            </div>
        </div>
    </div>
</div>
@endsection


