@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-700">Job Management</h1>
        @if(auth()->user()->hasPermission('job.create'))
            <a href="{{ route('admin.jobs.create') }}" class="btn btn-base-color">
                <i class="fas fa-plus me-2"></i> Post New Job
            </a>
        @endif
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-base-color">Active Job Listings</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Job ID</th>
                            <th>Job Details</th>
                            <th>Department</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Posted Date</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                        <tr>
                            <td><span class="fw-700 text-dark">{{ $job->job_code }}</span></td>
                            <td>
                                <div class="fw-700 text-dark">{{ $job->title }}</div>
                                <div class="text-muted small">{{ $job->project_name ?? 'No Project' }}</div>
                            </td>
                            <td>{{ $job->department }}</td>
                            <td><i class="bi bi-geo-alt me-1 text-muted"></i> {{ $job->location }}</td>
                            <td>
                                @if($job->status == 'Open')
                                    <span class="badge bg-success">Open</span>
                                @else
                                    <span class="badge bg-danger">Closed</span>
                                @endif
                            </td>
                            <td>{{ $job->created_at ? $job->created_at->format('d M, Y') : 'N/A' }}</td>
                            <td class="text-end">
                                <div class="btn-group shadow-sm border-0 rounded">
                                    @if(auth()->user()->hasPermission('job.edit'))
                                        <a href="{{ route('admin.jobs.edit', $job) }}" class="btn btn-white btn-sm" title="Edit Job">
                                            <i class="bi bi-pencil-square text-primary"></i>
                                        </a>
                                        <a href="{{ route('admin.jobs.applications.index', $job) }}" class="btn btn-white btn-sm" title="View Applications">
                                            <i class="bi bi-people-fill text-info"></i>
                                        </a>
                                        <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this job post?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-white btn-sm" title="Delete Job">
                                                <i class="bi bi-trash-fill text-danger"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if($jobs->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $jobs->links() }}
            </div>
        @endif
    </div>
</div>

<style>
    .btn-white {
        background: #fff;
        border: 1px solid #eee;
    }
    .btn-white:hover {
        background: #f8f9fa;
    }
</style>
@endsection
