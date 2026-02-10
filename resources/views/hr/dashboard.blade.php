@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">HR Dashboard</h1>
</div>

<div class="row">
    <!-- Pending -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending_applications'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shortlisted -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Shortlisted</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['shortlisted_applications'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Interviews -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Interviews</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['interview_scheduled_applications'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rejected -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Rejected</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['rejected_applications'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
