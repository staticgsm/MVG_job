@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">My Applications</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Job Title</th>
                                    <th>Applied On</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applications as $application)
                                    <tr>
                                        <td>
                                            <a href="{{ route('public.jobs.show', $application->jobPost) }}" class="text-decoration-none fw-bold">
                                                {{ $application->jobPost->title }}
                                            </a>
                                            <div class="text-muted small">{{ $application->jobPost->company_name ?? 'MVG Job' }}</div>
                                        </td>
                                        <td>{{ $application->applied_at }}</td>
                                        <td>
                                            <span class="badge bg-{{ $application->status == 'Applied' ? 'primary' : ($application->status == 'Shortlisted' ? 'success' : ($application->status == 'Rejected' ? 'danger' : 'warning')) }}">
                                                {{ $application->status }}
                                            </span>
                                        </td>
                                        <td>{{ $application->remarks ?? '-' }}</td>
                                        <td>
                                            @if($application->status == 'Applied')
                                                <form action="{{ route('candidate.applications.destroy', $application) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this application?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Cancel</button>
                                                </form>
                                            @else
                                                <span class="text-muted small">Cannot Cancel</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <p class="text-muted mb-2">You haven't applied to any jobs yet.</p>
                                            <a href="{{ route('public.jobs.index') }}" class="btn btn-primary btn-sm">Browse Jobs</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
