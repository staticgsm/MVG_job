@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Open Positions</h1>

    <div class="row">
        @forelse($jobs as $job)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $job->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $job->department }}</h6>
                        <p class="card-text">
                            <strong>Location:</strong> {{ $job->location }}<br>
                            <strong>Type:</strong> {{ $job->job_type }}
                        </p>
                        <a href="{{ route('public.jobs.show', $job) }}" class="btn btn-primary stretched-link">View Details</a>
                    </div>
                    <div class="card-footer text-muted">
                        Posted {{ $job->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="lead">No open positions at the moment. Please check back later.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $jobs->links() }}
    </div>
</div>
@endsection
