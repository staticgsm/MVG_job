@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-700">Job Applications</h1>
        <div class="text-muted small">Applications for: <span class="text-base-color fw-700">{{ $job->title }}</span></div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-base-color"><i class="bi bi-people-fill me-2"></i>Applicant Submissions</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Candidate</th>
                            <th>Contact Info</th>
                            <th>Status</th>
                            <th>Applied On</th>
                            <th class="text-end px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $application)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-base-color-light text-base-color rounded-circle me-3 d-flex align-items-center justify-content-center fw-700 border">
                                        {{ strtoupper(substr($application->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-700 text-dark">{{ $application->user->name }}</div>
                                        <div class="text-muted small">Profile: {{ $application->user->candidateProfile->profile_completion_percentage ?? 0 }}% complete</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fs-14"><i class="bi bi-envelope me-2 text-muted"></i>{{ $application->user->email }}</div>
                                <div class="text-muted small"><i class="bi bi-phone me-2"></i>{{ $application->user->mobile }}</div>
                            </td>
                            <td>
                                @php
                                    $statusClass = [
                                        'Applied' => 'bg-info',
                                        'Shortlisted' => 'bg-success',
                                        'Rejected' => 'bg-danger',
                                        'Interview Scheduled' => 'bg-warning'
                                    ][$application->status] ?? 'bg-secondary';
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ $application->status }}</span>
                                @if($application->remarks)
                                    <div class="text-muted small mt-1" style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $application->remarks }}">
                                        <i class="bi bi-chat-left-text me-1"></i> {{ $application->remarks }}
                                    </div>
                                @endif
                            </td>
                            <td>{{ $application->applied_at }}</td>
                            <td class="text-end px-4">
                                <button class="btn btn-white btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#updateModal-{{ $application->id }}">
                                    <i class="bi bi-pencil-square text-primary me-1"></i> Update
                                </button>

                                <!-- Update Modal -->
                                <div class="modal fade" id="updateModal-{{ $application->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <form action="{{ route('admin.jobs.applications.update', $application->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header border-bottom-0 pt-4 px-4">
                                                    <h5 class="modal-title fw-700 text-gray-800">Update Application Status</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4 text-start">
                                                    <div class="mb-4">
                                                        <label class="form-label">Application Status <span class="text-danger">*</span></label>
                                                        <select class="form-select" name="status" required>
                                                            <option value="Applied" {{ $application->status == 'Applied' ? 'selected' : '' }}>Applied</option>
                                                            <option value="Shortlisted" {{ $application->status == 'Shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                                                            <option value="Interview Scheduled" {{ $application->status == 'Interview Scheduled' ? 'selected' : '' }}>Interview Scheduled</option>
                                                            <option value="Rejected" {{ $application->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-0">
                                                        <label class="form-label">Internal Remarks (Optional)</label>
                                                        <textarea class="form-control" name="remarks" rows="3" placeholder="Add notes about this candidate...">{{ $application->remarks }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-top-0 pb-4 px-4">
                                                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-base-color px-4">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-3 opacity-25"></i>
                                No applications found for this job post.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($applications->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $applications->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .avatar-sm { width: 40px; height: 40px; border-radius: 50% !important; }
    .bg-base-color-light { background-color: rgba(239, 127, 26, 0.1); }
    .btn-white { background: #fff; border: 1px solid #eee; font-weight: 500; }
    .btn-white:hover { background: #f8f9fa; border-color: #ddd; }
</style>
@endsection
