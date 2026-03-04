@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-700">Notification Logs</h1>
        <a href="{{ route('admin.jobs.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-2"></i> Back to Jobs
        </a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-base-color">Notifications for Job: {{ $job->title }}</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Candidate Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Sent At</th>
                            <th>Error</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notifications as $notification)
                        <tr>
                            <td>{{ $notification->user->name }}</td>
                            <td>{{ $notification->user->email }}</td>
                            <td>
                                @if($notification->status == 'sent')
                                    <span class="badge bg-success">Sent</span>
                                @else
                                    <span class="badge bg-danger">Failed</span>
                                @endif
                            </td>
                            <td>{{ $notification->created_at->format('d M, Y H:i') }}</td>
                            <td class="text-danger small">{{ $notification->error_message ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No notification records found for this job.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($notifications->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
